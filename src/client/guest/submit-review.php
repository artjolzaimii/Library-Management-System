<?php
session_start();
require_once("../../../utilities/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to submit a review.");
    }

    $user_id = $_SESSION[''];
    $book_id = intval($_POST['book_id']);
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO review (book_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $book_id, $user_id, $rating, $comment); 


    if ($stmt->execute()) {
        // Redirect back to the book details page with the same ISBN
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
