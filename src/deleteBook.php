<?php
require_once("../utilities/config.php");

if (!isset($_GET['id'])) {
    die("Book ID not provided.");
}

$book_id = intval($_GET['id']);

// Delete from all format-specific tables
$conn->query("DELETE FROM sale_book WHERE book_id = $book_id");
$conn->query("DELETE FROM borrow_book WHERE book_id = $book_id");
$conn->query("DELETE FROM ebook WHERE book_id = $book_id");

// Delete from bridge tables (optional but recommended)
$conn->query("DELETE FROM book_author WHERE book_id = $book_id");
$conn->query("DELETE FROM book_genre WHERE book_id = $book_id");

// Delete from book table
$conn->query("DELETE FROM book WHERE book_id = $book_id");

header("Location: bookManagement.php");
exit();
