<?php
require_once("../../../utilities/config.php");
require_once("./styleAndScripts.php");


$selected_genre = isset($_GET['genre']) ? $_GET['genre'] : null;
if ($selected_genre) {
    $stmt = $conn->prepare("
        SELECT 
            book.book_id,
            book.title,
            book.description,
            book.image_path,
            sale_book.price,
            sale_book.inventory,
            author.full_name AS author_name
        FROM book
        JOIN book_genre ON book.book_id = book_genre.book_id
        JOIN genres ON book_genre.genre_id = genres.id
        LEFT JOIN sale_book ON book.book_id = sale_book.book_id
        LEFT JOIN book_author ON book.book_id = book_author.book_id
        LEFT JOIN author ON book_author.author_id = author.author_id
        WHERE genres.name = ?
    ");
    $stmt->bind_param("s", $selected_genre);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
   
    $result = $conn->query("
        SELECT 
            book.book_id,
            book.title,
            book.description,
            book.image_path,
            sale_book.price,
            sale_book.inventory,
            author.full_name AS author_name
        FROM book
        LEFT JOIN sale_book ON book.book_id = sale_book.book_id
        LEFT JOIN book_author ON book.book_id = book_author.book_id
        LEFT JOIN author ON book_author.author_id = author.author_id
        LIMIT 10
    ");
}
?>


