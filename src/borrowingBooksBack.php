<?php

require('../utilities/config.php');

$book_id = $_POST['book_id'] ?? null;
$borrow_date = $_POST['borrow_date'] ?? null;
$return_date = $_POST['return_date'] ?? null;
$full_name = $_POST['full_name'] ?? null;
$email = $_POST['email'] ?? null;
$phoneNumber = $_POST['phoneNumber'] ?? null;
$address = $_POST['address'] ?? null;

$sql = "
    INSERT INTO borrowed_books (book_id, user_name, user_email, user_phone, user_address, borrow_date, return_date)
    VALUES ('$book_id', '$full_name', '$email', '$phoneNumber', '$address', '$borrow_date', '$return_date');
    UPDATE borrow_book SET inventory = inventory - 1 WHERE book_id = '$book_id';
";

if (mysqli_multi_query($conn, $sql)) {
    echo "Book borrowed and inventory updated.";
} else {
    echo "Error: " . mysqli_error($conn);
}

header("Location: trackBorrowedBooks.php");
exit();

?>