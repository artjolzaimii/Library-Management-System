<?php
require_once("../utilities/config.php");

// DEBUG ONLY: enable during development
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (!isset($_POST['book_id'])) {
    die("Book ID not provided.");
}

$book_id = intval($_POST['book_id']);

// Sanitize input
function clean($conn, $str) {
    return mysqli_real_escape_string($conn, trim($str));
}

// Shared fields
$isbn = clean($conn, $_POST['isbn']);
$title = clean($conn, $_POST['title']);
$publicationYear = intval($_POST['publication_year']);
$publisher = clean($conn, $_POST['publisher']);
$nrPages = intval($_POST['nr_pages']);
$language = clean($conn, $_POST['language']);
$description = clean($conn, $_POST['description']);
$format = clean($conn, $_POST['format']);

// Format-specific
$inventory = 0;
$price = 0.00;
$condition = '';
$pdfName = '';

// Handle format-specific inputs
if ($format === 'For Sale') {
    $inventory = isset($_POST['inventory_sale']) ? floatval($_POST['inventory_sale']) : 0;
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;

    if ($inventory < 0 || $price < 0) {
        die("Inventory and price must be non-negative.");
    }
} elseif ($format === 'For Borrow') {
    $inventory = isset($_POST['inventory_borrow']) ? intval($_POST['inventory_borrow']) : 0;
    $condition = isset($_POST['book_condition']) ? clean($conn, $_POST['book_condition']) : '';

    if ($inventory < 0 || empty($condition)) {
        die("Invalid borrow book inputs.");
    }
} elseif ($format === 'E-Book') {
    if (isset($_FILES['bookPdf']) && $_FILES['bookPdf']['error'] === UPLOAD_ERR_OK) {
        $pdfTmp = $_FILES['bookPdf']['tmp_name'];
        $pdfName = uniqid() . "_" . basename($_FILES['bookPdf']['name']);
        move_uploaded_file($pdfTmp, "../uploads/eBooks/" . $pdfName);
    } else {
        $res = $conn->query("SELECT book_path FROM ebook WHERE book_id = $book_id");
        if ($res && $row = $res->fetch_assoc()) {
            $pdfName = $row['book_path'];
        }
    }
}

// Upload new image if provided
if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
    $imgTmp = $_FILES['imagePath']['tmp_name'];
    $imgName = uniqid() . "_" . basename($_FILES['imagePath']['name']);
    move_uploaded_file($imgTmp, "../uploads/images/" . $imgName);
    $conn->query("UPDATE book SET image_path='$imgName' WHERE book_id=$book_id");
}

// Update book table
$update = $conn->prepare("
    UPDATE book 
    SET isbn=?, title=?, publication_year=?, publisher=?, language=?, nr_pages=?, description=?, format=?
    WHERE book_id=?
");
$update->bind_param("ssississi", $isbn, $title, $publicationYear, $publisher, $language, $nrPages, $description, $format, $book_id);
if (!$update->execute()) {
    die("Error updating book: " . $update->error);
}
$update->close();

// Clear old format-specific entries
$conn->query("DELETE FROM sale_book WHERE book_id = $book_id");
$conn->query("DELETE FROM borrow_book WHERE book_id = $book_id");
$conn->query("DELETE FROM ebook WHERE book_id = $book_id");

// Insert new format-specific info
if ($format === 'For Sale') {
    $stmt = $conn->prepare("INSERT INTO sale_book (book_id, inventory, price) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $book_id, $inventory, $price);
    if (!$stmt->execute()) {
        die("Error inserting For Sale data: " . $stmt->error);
    }
    $stmt->close();

} 
elseif ($format === 'For Borrow') {
    $stmt = $conn->prepare("INSERT INTO borrow_book (book_id, inventory, book_condition) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $book_id, $inventory, $condition);
    if (!$stmt->execute()) {
        die("Error inserting For Borrow data: " . $stmt->error);
    }
    $stmt->close();

} 
elseif ($format === 'E-Book') {
    $stmt = $conn->prepare("INSERT INTO ebook (book_id, book_path) VALUES (?, ?)");
    $stmt->bind_param("is", $book_id, $pdfName);
    if (!$stmt->execute()) {
        die("Error inserting E-Book data: " . $stmt->error);
    }
    $stmt->close();
}

// Redirect after success
header("Location: bookManagement.php?tab=" . urlencode($format));

exit();
?>