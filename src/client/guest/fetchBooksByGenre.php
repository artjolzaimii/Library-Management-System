<?php
require_once("../../../utilities/config.php");
require_once("./styleAndScripts.php");

$selected_genre='';
if (isset($_GET['genre'])) {
    $selected_genre = $_GET['genre'];

    $sql = "
        SELECT b.book_id, b.isbn, b.publication_year, b.publisher, b.language, b.nr_pages, b.description, b.format, b.image_path
        FROM book b
        JOIN book_genre bg ON b.book_id = bg.book_id
        JOIN genres g ON bg.genre_id = g.id
        WHERE g.name = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selected_genre);
    $stmt->execute();
    $result = $stmt->get_result();
}
else{
    $sql = "
        SELECT b.book_id, b.isbn, b.publication_year, b.publisher, b.language, b.nr_pages, b.description, b.format, b.image_path
        FROM book b
        JOIN book_genre bg ON b.book_id = bg.book_id
        JOIN genres g ON bg.genre_id = g.id
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
