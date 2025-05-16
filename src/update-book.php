<?php
require_once("../utilities/config.php");

if (!isset($_POST['book_id'])) {
    die("Book ID not provided.");
}

$book_id = intval($_POST['book_id']);

function clean($conn, $str) {
    return mysqli_real_escape_string($conn, trim($str));
}

// Shared fields
$isbn = clean($conn, $_POST['isbn']);
$title = clean($conn, $_POST['title']);
$publicationYear = clean($conn, $_POST['publication_year']);
$publisher = clean($conn, $_POST['publisher']);
$nrPages = clean($conn, $_POST['nr_pages']);
$language = clean($conn, $_POST['language']);
$description = clean($conn, $_POST['description']);
$format = clean($conn, $_POST['format']);
$price = clean($conn, $_POST['price']);

// Format-based inventory
$inventory = '';
if ($format === 'For Sale') {
    $inventory = clean($conn, $_POST['inventory_sale']);
} elseif ($format === 'For Borrow') {
    $inventory = clean($conn, $_POST['inventory_borrow']);
} elseif ($format === 'E-Book') {
    $inventory = clean($conn, $_POST['inventory_ebook']);
}

// Update image if uploaded
if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
    $imgTmp = $_FILES['imagePath']['tmp_name'];
    $imgName = uniqid() . "_" . basename($_FILES['imagePath']['name']);
    move_uploaded_file($imgTmp, "../uploads/images/" . $imgName);
    $conn->query("UPDATE book SET image_path='$imgName' WHERE book_id=$book_id");
}

// Update book table
$update = $conn->prepare("UPDATE book SET isbn=?, title=?, price=?, inventory=?, publication_year=?, publisher=?, language=?, nr_pages=?, description=?, format=? WHERE book_id=?");
$update->bind_param("ssssdssissi", $isbn, $title, $price, $inventory, $publicationYear, $publisher, $language, $nrPages, $description, $format, $book_id);
$update->execute();

// Delete previous format-specific entries
$conn->query("DELETE FROM sale_book WHERE book_id = $book_id");
$conn->query("DELETE FROM borrow_book WHERE book_id = $book_id");
$conn->query("DELETE FROM ebook WHERE book_id = $book_id");

// Reinsert based on format
if ($format === 'For Sale') {
    $stmt = $conn->prepare("INSERT INTO sale_book (book_id, inventory, price) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $book_id, $inventory, $price);
    $stmt->execute();
    $stmt->close();

} elseif ($format === 'For Borrow') {
    $condition = clean($conn, $_POST['book_condition']);
    $stmt = $conn->prepare("INSERT INTO borrow_book (book_id, inventory, book_condition) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $book_id, $inventory, $condition);
    $stmt->execute();
    $stmt->close();

} elseif ($format === 'E-Book') {
    $pdfName = "";
    if (isset($_FILES['bookPdf']) && $_FILES['bookPdf']['error'] === UPLOAD_ERR_OK) {
        $pdfTmp = $_FILES['bookPdf']['tmp_name'];
        $pdfName = uniqid() . "_" . basename($_FILES['bookPdf']['name']);
        move_uploaded_file($pdfTmp, "../uploads/eBooks/" . $pdfName);
    }
    $stmt = $conn->prepare("INSERT INTO ebook (book_id, book_path) VALUES (?, ?)");
    $stmt->bind_param("is", $book_id, $pdfName);
    $stmt->execute();
    $stmt->close();
}

header("Location: bookManagement.php?tab=" . urlencode($format));

exit();
