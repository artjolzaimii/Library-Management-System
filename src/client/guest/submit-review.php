<?php
session_start();
require_once("../../../utilities/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['username'])) {
        die("You must be logged in to submit a review.");
    }

    $username = $_SESSION['username'];
    $book_id = intval($_POST['book_id']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO review (book_id, username, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $book_id, $username, $rating, $comment);

    if ($stmt->execute()) {
        $isbn = $_POST['isbn'] ?? '';
        header("Location: bookDetails.php?isbn=" . urlencode($isbn) . "&review=success");
        exit();
    } else {
        echo "Error submitting review: " . $stmt->error;
    }
} else {
    echo "Invalid access.";
}
?>
