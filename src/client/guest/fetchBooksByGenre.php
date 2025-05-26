<?php
require_once("../../../utilities/config.php");
require_once("./styleAndScripts.php");


$selected_genre = isset($_GET['genre']) ? $_GET['genre'] : null;

if ($selected_genre) {
    $stmt = $conn->prepare("SELECT 
            b.book_id,
            b.title,
            b.isbn,
            b.description,
            b.image_path,
            sb.price,
            format,
            sb.inventory,
            AVG(r.rating) AS avg_rating,
            COUNT(r.review_id) AS review_count,
            (SELECT GROUP_CONCAT(a.full_name SEPARATOR ', ')
                FROM book_author ba
                JOIN author a ON ba.author_id = a.author_id
                WHERE ba.book_id = b.book_id
            ) AS authors,
            (SELECT GROUP_CONCAT(g.name SEPARATOR ', ')
                FROM book_genre bg
                JOIN genres g ON bg.genre_id = g.id
                WHERE bg.book_id = b.book_id
            ) AS genres
        FROM book b
        JOIN book_genre bg ON b.book_id = bg.book_id
        JOIN genres g ON bg.genre_id = g.id
        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
        LEFT JOIN review r ON b.book_id = r.book_id
        WHERE g.name = ?
        GROUP BY b.book_id
        LIMIT 12
    ");
    $stmt->bind_param("s", $selected_genre);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT 
            b.book_id,
            b.title,
            b.isbn,
            b.description,
            b.image_path,
            format,
            sb.price,
            sb.inventory,
            AVG(r.rating) AS avg_rating,
            COUNT(r.review_id) AS review_count,
            (SELECT GROUP_CONCAT(a.full_name SEPARATOR ', ')
                FROM book_author ba
                JOIN author a ON ba.author_id = a.author_id
                WHERE ba.book_id = b.book_id
            ) AS authors,
            (SELECT GROUP_CONCAT(g.name SEPARATOR ', ')
                FROM book_genre bg
                JOIN genres g ON bg.genre_id = g.id
                WHERE bg.book_id = b.book_id
            ) AS genres
        FROM book b
        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
        LEFT JOIN review r ON b.book_id = r.book_id
        GROUP BY b.book_id
        ORDER BY RAND()
        LIMIT 12
    ");
}
?>


