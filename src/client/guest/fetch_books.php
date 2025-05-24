<?php
require_once("../../../utilities/config.php");

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

    echo '<div class="container">';
    echo '<div class="swiper book-slider" ';
    echo '<div class="swiper-wrapper">';

    if ($result && $result->num_rows > 0) {
        while ($book = $result->fetch_assoc()) {
            $img = !empty($book['image_path']) ? $book['image_path'] : '../assets/img/book/default.png';
            $author = "Author Unknown";
            $price = "$20.00";
            $old_price = "$30.00";

            echo '
            <div class="swiper-slide">
                <div class="shop-box-items style-2">
                    <div class="book-thumb center">
                        <a href="shop-details.php?book_id=' . $book['book_id'] . '">
                            <img src="' . htmlspecialchars($img) . '" alt="Book Image">
                        </a>
                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                            <li><a href="shop-cart.html"><i class="far fa-heart"></i></a></li>
                            <li><a href="shop-cart.html"><img class="icon" src="../assets/img/icon/shuffle.svg" alt="Shuffle Icon"></a></li>
                            <li><a href="shop-details.php?book_id=' . $book['book_id'] . '"><i class="far fa-eye"></i></a></li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.php?book_id=' . $book['book_id'] . '" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                    <div class="shop-content">
                        <h5>Design Low Book</h5>
                        <h3><a href="shop-details.php?book_id=' . $book['book_id'] . '">' . htmlspecialchars($book['description'] ?: "No Title") . '</a></h3>
                        <ul class="price-list">
                            <li>' . $price . '</li>
                            <li><del>' . $old_price . '</del></li>
                        </ul>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="thumb"><img src="../assets/img/testimonial/client-1.png" alt="Author Image"></span>
                                <span class="content">' . htmlspecialchars($author) . '</span>
                            </li>
                            <li><i class="fa-solid fa-star"></i>3.4 (25)</li>
                        </ul>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<p>No books found for this genre.</p>';
    }

    echo '</div>'; 
    echo '</div>'; 
    echo '</div>'; 
}
?>
