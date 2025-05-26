<?php 
    require_once('../utilities/config.php');
    
    function sendMail($to, $subject, $message) {
    // There should be out email
    $headers = "From: library@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    // For real use, set a valid From address and configure your mail server
    return mail($to, $subject, $message, $headers);
    }

    $book_id = intval($_POST['book_id']);
    $format = $_POST['format'];
    $new_inventory = intval($_POST['inventory']);

    // Get previous inventory
    if ($format === 'For Sale') {
        $inv_query = "SELECT inventory FROM sale_book WHERE book_id = $book_id";
    } else {
        $inv_query = "SELECT inventory FROM borrow_book WHERE book_id = $book_id";
    }
    $inv_result = mysqli_query($conn, $inv_query);
    $row = mysqli_fetch_assoc($inv_result);
    $prev_inventory = $row ? intval($row['inventory']) : 0;

    // Update inventory
    if ($format === 'For Sale') {
        $update_query = "UPDATE sale_book SET inventory = $new_inventory WHERE book_id = $book_id";
    } else {
        $update_query = "UPDATE borrow_book SET inventory = $new_inventory WHERE book_id = $book_id";
    }
    mysqli_query($conn, $update_query);

    // Notify users if restocked from 0
    if ($prev_inventory == 0 && $new_inventory > 0) {
        $book = mysqli_fetch_assoc(mysqli_query($conn, "SELECT title FROM books WHERE id = $book_id"));
        $book_title = $book ? $book['title'] : 'the book you wished for';
        $user_query = "
            SELECT u.email, u.full_name
            FROM wishlist w
            JOIN users u ON w.user_id = u.id
            WHERE w.book_id = $book_id AND w.notified = 0
        ";
        $user_result = mysqli_query($conn, $user_query);
        while ($user = mysqli_fetch_assoc($user_result)) {
            $to = $user['email'];
            $subject = "Book Available";
            $message = "Hi {$user['full_name']},\n\n\"$book_title\" is now available in the library!";
            sendMail($to, $subject, $message);
        }

        // Mark users as notified
        $update_wishlist = "UPDATE wishlist SET notified = 1 WHERE book_id = $book_id";
        mysqli_query($conn, $update_wishlist);
    }

    header("Location: stockManagement.php");
    exit;
?>