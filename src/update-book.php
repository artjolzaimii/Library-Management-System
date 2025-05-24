<?php
require_once("../utilities/config.php");

if (!isset($_POST['book_id'])) {
    die("Book ID not provided.");
}

$book_id = intval($_POST['book_id']);

function clean($conn, $str) {
    return mysqli_real_escape_string($conn, trim($str));
}

$isbn = clean($conn, $_POST['isbn']);
$title = clean($conn, $_POST['title']);
$publicationYear = intval($_POST['publication_year']);
$publisher = clean($conn, $_POST['publisher']);
$nrPages = intval($_POST['nr_pages']);
$language = clean($conn, $_POST['language']);
$description = clean($conn, $_POST['description']);
$format = clean($conn, $_POST['format']);

$authors = isset($_POST['author']) ? explode(',', clean($conn, $_POST['author'])) : [];
$genres = isset($_POST['genres']) ? explode(',', clean($conn, $_POST['genres'])) : [];

$inventory = 0;
$price = 0.00;
$condition = '';
$pdfName = '';

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

if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
    $imgTmp = $_FILES['imagePath']['tmp_name'];
    $imgName = uniqid() . "_" . basename($_FILES['imagePath']['name']);
    move_uploaded_file($imgTmp, "../uploads/images/" . $imgName);
    $conn->query("UPDATE book SET image_path='$imgName' WHERE book_id=$book_id");
}

$update = $conn->prepare("UPDATE book SET isbn=?, title=?, publication_year=?, publisher=?, language=?, nr_pages=?, description=?, format=? WHERE book_id=?");
$update->bind_param("ssississi", $isbn, $title, $publicationYear, $publisher, $language, $nrPages, $description, $format, $book_id);
if (!$update->execute()) {
    die("Error updating book: " . $update->error);
}
$update->close();

$conn->query("DELETE FROM sale_book WHERE book_id = $book_id");
$conn->query("DELETE FROM borrow_book WHERE book_id = $book_id");
$conn->query("DELETE FROM ebook WHERE book_id = $book_id");
$conn->query("DELETE FROM book_author WHERE book_id = $book_id");
$conn->query("DELETE FROM book_genre WHERE book_id = $book_id");

if ($format === 'For Sale') {
    $stmt = $conn->prepare("INSERT INTO sale_book (book_id, inventory, price) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $book_id, $inventory, $price);
    if (!$stmt->execute()) {
        die("Error inserting For Sale data: " . $stmt->error);
    }
    $stmt->close();
} elseif ($format === 'For Borrow') {
    $stmt = $conn->prepare("INSERT INTO borrow_book (book_id, inventory, book_condition) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $book_id, $inventory, $condition);
    if (!$stmt->execute()) {
        die("Error inserting For Borrow data: " . $stmt->error);
    }
    $stmt->close();
} elseif ($format === 'E-Book') {
    $stmt = $conn->prepare("INSERT INTO ebook (book_id, book_path) VALUES (?, ?)");
    $stmt->bind_param("is", $book_id, $pdfName);
    if (!$stmt->execute()) {
        die("Error inserting E-Book data: " . $stmt->error);
    }
    $stmt->close();
}

foreach ($authors as $author_name) {
    $author_name = trim($author_name);
    $author_check = $conn->prepare("SELECT author_id FROM author WHERE full_name = ?");
    $author_check->bind_param("s", $author_name);
    $author_check->execute();
    $author_result = $author_check->get_result();

    if ($author_row = $author_result->fetch_assoc()) {
        $author_id = $author_row['author_id'];
    } else {
        $insert_author = $conn->prepare("INSERT INTO author (full_name) VALUES (?)");
        $insert_author->bind_param("s", $author_name);
        $insert_author->execute();
        $author_id = $insert_author->insert_id;
        $insert_author->close();
    }
    $conn->query("INSERT INTO book_author (book_id, author_id) VALUES ($book_id, $author_id)");
}

foreach ($genres as $genre_name) {
    $genre_name = trim($genre_name);
    $genre_check = $conn->prepare("SELECT id FROM genres WHERE name = ?");
    $genre_check->bind_param("s", $genre_name);
    $genre_check->execute();
    $genre_result = $genre_check->get_result();

    if ($genre_row = $genre_result->fetch_assoc()) {
        $genre_id = $genre_row['id'];
    } else {
        $insert_genre = $conn->prepare("INSERT INTO genres (name) VALUES (?)");
        $insert_genre->bind_param("s", $genre_name);
        $insert_genre->execute();
        $genre_id = $insert_genre->insert_id;
        $insert_genre->close();
    }
    $conn->query("INSERT INTO book_genre (book_id, genre_id) VALUES ($book_id, $genre_id)");
}

header("Location: bookManagement.php?tab=" . urlencode($format));
exit();
?>
