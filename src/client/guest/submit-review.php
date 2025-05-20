<?php
require_once("../../../utilities/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $book_id = $_POST['book_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO reviews (book_id, name, email, rating, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $book_id, $name, $email, $rating, $message);
    $stmt->execute();

    header("Location: shop-details.php?book_id=$book_id&review=success");
    exit();
}
?>
