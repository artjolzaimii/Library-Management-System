<?php 
    include("clientMenu.php");
    require_once("../../../utilities/config.php");
    require_once("wishlistFunctionality.php");
?>

<!DOCTYPE html>
<html lang="en">
<!--<< Header Area >>-->

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="pixel-plus">
    <meta name="description" content="EternaLibrary - Books Library eCommerce Store">
    <!-- ======== Page title ============ -->
    <title>Eterna Library - Books Library eCommerce Store</title>
    
    <?php 
        require_once("./styleAndScripts.php");
    ?>
    
</head>

<body>

    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    <!-- Preloader Start -->
     <?php 
        require("loading.php");
     ?>

    <!-- Back To Top Start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="index.html">
                                <img src="../assets/img/logo/logo.svg" alt="logo-img">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text d-none d-xl-block">
                        Nullam dignissim, ante scelerisque the is euismod fermentum odio sem semper the is erat, a
                        feugiat leo urna eget eros. Duis Aenean a imperdiet risus.
                    </p>
                    <div class="mobile-menu fix mb-3"></div>
                    <div class="offcanvas__contact">
                        <h4>Contact Info</h4>
                        <ul>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="index-2.html">Main Street, Melbourne, Australia</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:info@example.com"><span
                                            class="mailto:info@example.com">info@example.com</span></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a target="_blank" href="index-2.html">Mod-friday, 09am -05pm</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="offcanvas__contact-icon mr-15">
                                    <i class="far fa-phone"></i>
                                </div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:+11002345909">+11002345909</a>
                                </div>
                            </li>
                        </ul>
                        <div class="header-button mt-4">
                            <a href="contact.html" class="theme-btn text-center">
                                Get A Quote <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                        <div class="social-icon d-flex align-items-center">
                            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://x.com/"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>
    <!-- Header Section Start -->

    <!-- Sidebar Area Here -Log in page- -->
    <?php 
        require("logInSidebar.php");
    ?>

    <!-- Hero Section start  -->
    <div class="hero-section hero-2 fix bg-cover" style="background-image: url(../assets/img/hero/hero-bg-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8 col-lg-6">
                    <div class="hero-items">
                        <div class="book-shape float-bob-y">
                            <img src="../assets/img/hero/book.png" alt="shape-img">
                        </div>
                        <div class="book-shape-2 float-bob-y">
                            <img src="../assets/img/hero/hero-book-shape.png" alt="">
                        </div>
                        <div class="bg-shape1">
                            <img src="../assets/img/hero/bg-shape.png" alt="img">
                        </div>
                        <div class="hero-content">
                            
                            <h1 class="wow fadeInUp" data-wow-delay=".5s">
                                Open a Book,<br>Unlock a <br><span>World of Wonder
                                    <img src="../assets/img/hero/hero-line-shape.png" alt="shape">
                                </span>
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay=".7s">
                                Where stories breathe, and pages sing—<br>
                                A world awaits in everything.
                            </p>

                            <div class="form-clt wow fadeInUp" data-wow-delay=".9s">
                                <button type="button" class="theme-btn" onclick="window.location.href='shopList.php';">
                                    Shop Now <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                                <button type="button" class="theme-btn style-2" onclick="window.location.href='shopList.php';">
                                    View All Books <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-xl-4 col-lg-6">
                    <div class="girl-image float-bob-x">
                        <img src="../assets/img/book/prideandprejudice.png" height="743 px" width="589 px" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Banner Section start  -->
    <section class="book-banner-section fix section-padding">
    <div class="container">
        <div class="swiper book-slider-genre">
            <div class="swiper-wrapper">
                <?php 
                $sql = "SELECT * FROM genres"; 
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()): ?>
                    <div class="swiper-slide">
                        <div class="banner-book-card-items bg-cover" style="background-image: url('../assets/img/banner/category_banner.jpg');">
                            <div class="book-shape">
                                <img src="../assets/img/banner/book-<?= ($row['id']%2+2) ?>.png" alt="img">
                            </div>
                            <div class="banner-book-content">
                                <div class="banner-text">
                                    <h2><?= htmlspecialchars($row['name']) ?></h2>
                                    <p>Fall in love with these <?php echo $row['name']?> stories</p>
                                </div>
                                <a href="#shop-section" class="banner-icons" onclick="window.location.href='mainPage.php?genre=<?= urlencode($row['name']) ?>'">
                                    <img src="../assets/img/icon/icon-25.svg" alt="icon">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>


    
    <!-- Shop Section -->
    <?php 
    require_once("./fetchBooksByGenre.php");
    //Handle add to cart
    if(isset($_GET['add'])){
            addBookToBasket($conn,$_GET['add'],1);
        }
?>
<section id="shop-section" class="shop-section section-padding fix pt-0">
    <div class="container">
        <div class="section-title-area">
            <div class="section-title">
                <h2>
                    <?php 
                        echo $selected_genre ? "Books in Genre: " . htmlspecialchars($selected_genre) : "Top Category Books"; 
                    ?>
                </h2>
            </div>
            <a href="shopList.php<?php (isset($selected_genre)? "?Genre=".$selected_genre : "")?>" class="theme-btn style-2">Explore More <i class="fa-solid fa-arrow-right-long"></i></a>
        </div>

        <div class="swiper book-slider-genre" id="shop-books-container">
            <div class="swiper-wrapper">
                <?php 
                if ($result && $result->num_rows > 0) {
                    while ($book = $result->fetch_assoc()) {
                        $img = !empty($book['image_path']) ? $book['image_path'] : '../assets/img/book/01.png';

                        echo '
                            <div class="swiper-slide">
                                <div class="shop-box-items style-2">
                                    <div class="book-thumb center">
                                        <a href="shop-details.php?book_id=' . htmlspecialchars($book['book_id']) . '">
                                            <img src="../../../Uploads/images/' . htmlspecialchars($img) . '" alt="img">
                                        </a>
                                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                                            <li><a href="wishlist.php?add=' . $book['book_id'] . '" class="icon"><i class="far fa-heart"></i></a></li>
                                            <li><a href="bookDetails.php?isbn=' . htmlspecialchars($book['isbn']) . '"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                        <div class="shop-button">
                                            <a href="' . ($book['format'] === 'For Borrow' ? '#' : 'mainPage.php?add=' . htmlspecialchars($book['book_id'])) . '"
                                             class="theme-btn' . ($book['format'] === 'For Borrow' ? ' disabled' : '') . '"
                                             ' . ($book['format'] === 'For Borrow' ? 'onclick="return false;"' : '') . '>
                                             ' . ($book['format'] === 'For Sale' ? 'Add To Cart' : ($book['format'] === 'E-Book' ? 'Read/Download' : 'Free Borrow')) . '
                                          </a>
                                        </div>
                                    </div>
                                    <div class="shop-content">
                                        <h5>' . htmlspecialchars($book['genres'] ?? 'No Genres') . '</h5>
                                        <h3><a href="bookDetails.php?isbn=' . htmlspecialchars($book['isbn']) . '">' . htmlspecialchars($book['title'] ?? 'No Title') . '</a></h3>
                                        <ul class="price-list">
                                            <li>' . ($book['format'] === 'For Sale' ? '$' . htmlspecialchars($book['price'] ?? '20.00') : ($book['format'] === 'For Borrow' ? 'Free' : 'Free')) . '</li>
                                        </ul>
                                        <ul class="author-post">
                                            <li class="authot-list">
                                                <span class="thumb"><img src="../assets/img/testimonial/client-4.png" alt="img"></span>
                                                <span class="content">' . htmlspecialchars($book['authors'] ?? 'Author Unknown') . '</span>
                                            </li>
                                            <li><i class="fa-solid fa-star"></i>' . round($book['avg_rating'] ?? 0) . ' (' . round($book['review_count'] ?? 0) . ')</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<p>No books found for this genre.</p>';
                }
                ?>
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

 <!-- Top Ratting Book Section start  -->
   <section class="top-ratting-book-section fix section-padding bg-cover" style="background-image: url(assets/img/ratting-bg.jpg);">
    <div class="container">
        <div class="top-ratting-book-wrapper">
            <div class="section-title-area">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Top Rating Books</h2>
                </div>
                <a href="shopList.php" class="theme-btn wow fadeInUp" data-wow-delay=".5s">
                    view more books <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
            <div class="row">
                <?php

                $query = "SELECT 
                        b.book_id, b.isbn, b.title, b.image_path, sb.price,
                        AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count,
                        (SELECT GROUP_CONCAT(a.full_name SEPARATOR ', ')
                         FROM book_author ba 
                         JOIN author a ON ba.author_id = a.author_id 
                         WHERE ba.book_id = b.book_id) AS authors
                    FROM book b
                    LEFT JOIN review r ON b.book_id = r.book_id
                    LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                    GROUP BY b.book_id, b.isbn, b.title, b.image_path, sb.price
                    ORDER BY avg_rating DESC
                    LIMIT 6;
                ";

                $result = $conn->query($query);
                while ($book = $result->fetch_assoc()):
                    $book_url = "bookDetails.php?isbn=" . urlencode($book['isbn']);

                    $image_path = "../../../uploads/images/" . htmlspecialchars($book['image_path']);
                ?>
                <div class="col-xl-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="top-ratting-box-items">
                        <div class="book-thumb">
                            <a href="<?= $book_url ?>">
                               <img src="<?= $image_path ?>" alt=img>

                            </a>
                        </div>
                        <div class="book-content">
                            <div class="title-header d-flex justify-content-between">
                                <div>
                                    <h5><?= htmlspecialchars($book['authors'] ?? 'Unknown Author') ?></h5>
                                    <h3><a href="<?= $book_url ?>"><?= htmlspecialchars($book['title']) ?></a></h3>
                                </div>
                                <ul class="shop-icon d-flex align-items-center">
                                    <?php 
                                        echo '<li><a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Toggle wishlist">
                                                <i class="' . (isset($_SESSION['username']) && isInWishlist($book['book_id'], getUserId($_SESSION['username'])) ? 'fas' : 'far') . ' fa-heart"></i>
                                              </a></li>';
                                    ?>
                                    
                                    <li><a href="<?= $book_url ?>"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <span class="mt-10"><?= isset($book['price']) ? number_format($book['price'], 2) . ' ALL' : 'N/A' ?></span>
                            <ul class="author-post">
                                <li class="authot-list">
                                    <span class="thumb">
                                        <img src="../assets/img/testimonial/client-4.png" alt="img">
                                    </span>
                                    <span class="content mt-10"><?= htmlspecialchars($book['authors'] ?? 'Unknown') ?></span>
                                </li>
                            </ul>
                            <div class="shop-btn">
                                <div class="star">
                                    <?php
                                    $rating = round($book['avg_rating']);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<i class="fa-' . ($i <= $rating ? 'solid' : 'regular') . ' fa-star"></i>';
                                    }
                                    ?>
                                    (<?= $book['review_count'] ?>)
                                </div>
                                <a href="shopList.php?add=<?php echo $book['book_id']?>" class="theme-btn">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

    <!-- Best Sellers -->
    <?php 
        //Get top10 sold books
        $query = "SELECT 
                    b.book_id, b.isbn, b.title, b.image_path, sb.price, sb.inventory,
                    AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count,
                    (SELECT GROUP_CONCAT(a.full_name SEPARATOR ', ') 
                     FROM book_author ba  
                     JOIN author a ON ba.author_id = a.author_id  
                     WHERE ba.book_id = b.book_id) AS authors,
                    (SELECT GROUP_CONCAT(g.name SEPARATOR ', ') 
                     FROM book_genre bg  
                     JOIN genres g ON bg.genre_id = g.id  
                     WHERE bg.book_id = b.book_id) AS genres
                FROM book b
                LEFT JOIN order_book ob ON b.book_id = ob.book_id
                LEFT JOIN review r ON b.book_id = r.book_id
                INNER JOIN  sale_book sb ON b.book_id = sb.book_id
                GROUP BY b.book_id, b.isbn, b.title, b.image_path, sb.price, sb.inventory
                ORDER BY COUNT(ob.order_id) DESC
                LIMIT 10
            ";

        $top10=mysqli_query($conn,$query);                          
                                    
    ?>
    <section class="featured-books-section pt-100 pb-145 fix section-bg">
        <div class="container">
            <div class="section-title-area justify-content-center">
                <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                    <h2>Bestseller Books</h2>
                </div>
            </div>

            <div class="swiper featured-books-slider">
                <div class="swiper-wrapper">
                    
                    <?php 
                        while($book=$top10->fetch_assoc()):
                    ?>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-4 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="bookDetails.php?isbn=<?php echo $book['isbn']?>"><img src="../../../uploads/images/<?php echo $book['image_path']?>" alt="img" width="168" height="275"></a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                    <li class="book-category-badge"><?php echo $book['genres']?></li>
                                    <li>
                                        <div class="star">
                                            <?php
                                            $rating = round($book['avg_rating']);
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<i class="fa-' . ($i <= $rating ? 'solid' : 'regular') . ' fa-star"></i>';
                                            }
                                            ?>(<?= $book['review_count'] ?>)
                                        </div>
                                    </li>
                                        
                                </ul>
                                <h3><a href="bookDetails.php?isbn=<?php echo $book['isbn']?>"><?php echo $book['title']?></a></h3>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-4.png" alt="img">
                                        </span>
                                        <span class="content"><?php echo $book['authors'] ?></span>
                                    </li>
                                </ul>
                                <div class="book-availablity">
                                    <div class="details">
                                        <ul class="price-list">
                                            <li><?php echo $book['price']?> All</li>
                                        </ul>
                                        <div class="progress-container" style="width: 100%; height: 16px; background: #f3f3f3; border-radius: 8px; overflow: hidden; box-shadow: inset 0 1px 2px rgba(0,0,0,0.1); margin-top: 8px;">
                                            <?php
                                                $inventory = isset($book['inventory']) ? (int)$book['inventory'] : 0;
                                                $barPercent = $inventory > 100 ? 100 : ($inventory < 0 ? 0 : $inventory);
                                                $barColor = $inventory > 10 ? '#ff7b6b' : ($inventory > 0 ? '#ffc107' : '#f44336');
                                            ?>
                                            <div class="progress-line" id="progressLine"
                                                 style="width: <?= $barPercent ?>%; height: 100%; background: <?= $barColor ?>; transition: width 0.4s ease;">
                                            </div>
                                        </div>

                                        
                                        <p><?php echo $book['inventory']?> Books in stock</p>
                                    </div>

                                    <div class="shop-btn">
                                        <a href="mainPage.php?add=<?php echo $book['book_id']?>">
                                            <i class="fa-regular fa-basket-shopping"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <?php endwhile;?>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
                    <!-- E-Book Section Start -->
                    <?php
                    $query = "SELECT b.*, e.book_path, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count,
                            (SELECT GROUP_CONCAT(a.full_name SEPARATOR ', ') 
                                FROM book_author ba  
                                JOIN author a ON ba.author_id = a.author_id  
                                WHERE ba.book_id = b.book_id) AS authors,
                            (SELECT GROUP_CONCAT(g.name SEPARATOR ', ') 
                                FROM book_genre bg  
                                JOIN genres g ON bg.genre_id = g.id  
                                WHERE bg.book_id = b.book_id) AS genres
                            FROM book b
                            LEFT JOIN ebook e ON b.book_id = e.book_id
                            LEFT JOIN review r ON b.book_id = r.book_id
                            WHERE b.format='E-Book'
                            GROUP BY b.book_id
                            LIMIT 4";
                    $ebooks = mysqli_query($conn, $query);
                    ?>
                    <section class="best-seller-section section-padding fix" id="bestseller">
                    <div class="container">
                        <div class="section-title-area">
                        <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                            <h2>E-Books</h2>
                        </div>
                        <a href="shopList.php?format=ebook" class="theme-btn style-2 wow fadeInUp" data-wow-delay=".5s">
                            Explore More <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                        </div>
                        <div class="book-shop-wrapper style-2">
                        <?php while ($book = $ebooks->fetch_assoc()): ?>
                            <div class="shop-box-items style-3 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="bookDetails.php?isbn=<?= htmlspecialchars($book['isbn']) ?>">
                                <img src="../../../uploads/images/<?= htmlspecialchars($book['image_path']) ?>" alt="img" width="357px" height="570px">
                                </a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                <li class="book-category-badge"><?= htmlspecialchars($book['genres']) ?></li>
                                <li>
                                    <i class="fa-solid fa-star"></i>
                                    <?= round($book['avg_rating']) ?> (<?= $book['review_count'] ?>)
                                </li>
                                </ul>
                                <h3><a href="bookDetails.php?isbn=<?= htmlspecialchars($book['isbn']) ?>"><?= htmlspecialchars($book['title']) ?></a></h3>
                                <ul class="author-post">
                                <li class="authot-list">
                                    <span class="content"><?= htmlspecialchars($book['authors']) ?></span>
                                </li>
                                </ul>
                                <ul class="price-list">
                                <li>Free</li>
                                </ul>
                                <div class="shop-button d-flex gap-2">
                                <?php
                                    $ebookPath = $book['book_path'] ? "../../../uploads/eBooks/" . $book['book_path'] : null;
                                    if ($ebookPath && file_exists($ebookPath)):
                                ?>
                                    <a href="<?= htmlspecialchars($ebookPath) ?>" target="_blank" class="theme-btn">Read</a>
                                    <a href="<?= htmlspecialchars($ebookPath) ?>" download class="theme-btn">
                                    <i class="fa-solid fa-download"></i> Download
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No Preview Available</span>
                                <?php endif; ?>
                                </div>
                            </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                    </div>
                    </section>


    <!-- Feature Section Start -->
    <section class="feature-section fix section-padding pt-0" id="ebook">
        <div class="container">
            <div class="feature-wrapper">
                <div class="feature-box-items wow fadeInUp" data-wow-delay=".2s">
                    <div class="icon">
                        <i class="icon-icon-1"></i>
                    </div>
                    <div class="content">
                        <h3>Return & refund</h3>
                        <p>Money back guarantee</p>
                    </div>
                </div>
                <div class="feature-box-items wow fadeInUp" data-wow-delay=".4s">
                    <div class="icon">
                        <i class="icon-icon-2"></i>
                    </div>
                    <div class="content">
                        <h3>Secure Payment</h3>
                        <p>30% off by subscribing</p>
                    </div>
                </div>
                <div class="feature-box-items wow fadeInUp" data-wow-delay=".6s">
                    <div class="icon">
                        <i class="icon-icon-3"></i>
                    </div>
                    <div class="content">
                        <h3>Quality Support</h3>
                        <p>Always online 24/7</p>
                    </div>
                </div>
                <div class="feature-box-items wow fadeInUp" data-wow-delay=".8s">
                    <div class="icon">
                        <i class="icon-icon-4"></i>
                    </div>
                    <div class="content">
                        <h3>Daily Offers</h3>
                        <p>20% off by subscribing</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Borrow Book Section Start -->
    <?php
        $query="SELECT b.*,bb.inventory,bb.book_condition, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count,
                (SELECT GROUP_CONCAT(a.full_name SEPARATOR ', ') 
                     FROM book_author ba  
                     JOIN author a ON ba.author_id = a.author_id  
                     WHERE ba.book_id = b.book_id) AS authors,
                    (SELECT GROUP_CONCAT(g.name SEPARATOR ', ') 
                     FROM book_genre bg  
                     JOIN genres g ON bg.genre_id = g.id  
                     WHERE bg.book_id = b.book_id) AS genres
                FROM book b LEFT JOIN review r ON b.book_id = r.book_id
                INNER JOIN borrow_book bb ON bb.book_id=b.book_id 
                WHERE b.format='For Borrow'
                GROUP BY b.book_id
                LIMIT 10"
                ;
        $borrowBooks=mysqli_query($conn, $query);
        
    ?>
    <section class="shop-section section-padding fix pt-0" id="borrow">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                    <h2>Discover Some Books You Can Borrow for free</h2>
                </div>
                <a href="shopList.php?format=borrow" class="theme-btn style-2 wow fadeInUp" data-wow-delay=".5s">
                    Explore More <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>
            <div class="swiper borrow-books-slider">
                <div class="swiper-wrapper">
                    <?php while($book = $borrowBooks->fetch_assoc()): ?>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="shop-details.php?isbn=<?php echo urlencode($book['isbn']); ?>">
                                    <img src="../../../uploads/images/<?php echo htmlspecialchars($book['image_path']); ?>" alt="img">
                            </a>
                            <ul class="shop-icon d-grid justify-content-center align-items-center">
                                <li>
                                    <a href="wishlist.php?add=3"><i class="far fa-heart"></i></a>
                                </li>
                                <li>
                                    <a href="bookDetails.php?isbn=<?php echo urlencode($book['isbn']); ?>"><i class="far fa-eye"></i></a>
                                </li>
                            </ul>
                            <div class="shop-button">
                                <button class="theme-btn" disabled>Borrow for free</button>
                            </div>
                        </div>
                        <div class="shop-content">
                            <h5>Condition: <?php echo htmlspecialchars($book['book_condition']); ?></h5>
                            <h3>
                                <a href="shop-details.php?isbn=<?php echo urlencode($book['isbn']); ?>">
                                    <?php echo htmlspecialchars($book['title']); ?>
                                </a>
                            </h3>
                            <ul class="price-list">
                                <li>Free</li>
                            </ul>
                            <ul class="author-post">
                                <li class="authot-list">
                                    <span class="thumb">
                                        <img src="../assets/img/testimonial/client-4.png" alt="img">
                                    </span>
                                    <span class="content"><?php echo htmlspecialchars($book['authors']); ?></span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-star"></i>
                                    <?php echo ($book['avg_rating'] == 0 ? 0 : round($book['avg_rating'])); ?> (<?php echo $book['review_count']; ?>)
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var borrowSwiper = new Swiper('.borrow-books-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.borrow-books-slider .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.borrow-books-slider .swiper-button-next',
            prevEl: '.borrow-books-slider .swiper-button-prev',
        },
        breakpoints: {
            768: { slidesPerView: 2 },
            1200: { slidesPerView: 3 }
        }
    });
});
</script>

    <!-- Cta Banner Section Start -->
    <section class="cta-banner-section fix section-padding pt-0">
        <div class="container">
            <div class="cta-banner-wrapper-2 section-padding bg-cover"
                style="background-image: url('../assets/img/banner/book_banner.png');">
                <div class="cta-content-wrappers">
                    <div class="cta-texts">
                        <span class="wow fadeInUp">Find here</span>
                        <h2 class="text-white mb-40 wow fadeInUp" data-wow-delay=".3s">the best deals <br> for Bestseller books</h2>
                    </div>
                    <div class="ctx-btn">
                        <a href="shopList.php" class="theme-btn white-bg wow fadeInUp" data-wow-delay=".5s">
                            Shop Now <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section Start -->
    <?php 
        $query="SELECT a.author_id, a.full_name, a.image_path, COUNT(ba.book_id) as nr_books
                FROM author a LEFT JOIN book_author ba ON a.author_id=ba.author_id
                GROUP BY a.author_id;";
        $result=mysqli_query($conn,$query);
    ?>
    
    <section class="team-section fix section-padding pt-0 margin-bottom-30" id="authors">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="mb-3 wow fadeInUp" data-wow-delay=".3s">Featured Author</h2>
                <p class="wow fadeInUp" data-wow-delay=".5s">Meet our featured authors—visionary storytellers shaping the literary world. Discover their best works and let their words inspire you."</p>
            </div>
            <div class="array-button">
                <button class="array-prev"><i class="fal fa-arrow-left"></i></button>
                <button class="array-next"><i class="fal fa-arrow-right"></i></button>
            </div>
            <div class="swiper team-slider">
                <div class="swiper-wrapper">
                <?php while($author=$result->fetch_assoc()):?>
                    <div class="swiper-slide">
                        <div class="team-box-items">
                            <div class="team-image">
                                <div class="thumb">
                                    <img src="../../../<?php echo $author['image_path']?>" alt="img" height="104px" width="104px">
                                </div>
                                <div class="shape-img">
                                    <img src="../assets/img/team/shape-img.png" alt="img">
                                </div>
                            </div>
                            <div class="team-content text-center">
                                <h6><a href="authorProfile.php?authorId=<?php echo $author['author_id']?>"><?php echo $author['full_name']?></a></h6>
                                <p><?php echo $author['nr_books']?> Published Books</p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>    
                </div>
            </div>
        </div>
    </section>

    <!-- News Section Start -->
    <section class="news-section fix section-padding bg-cover" style="background-image: url(../assets/img/news/bg.jpg);">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="mb-3 wow fadeInUp" data-wow-delay=".3s">Our Latest News</h2>
                <p class="wow fadeInUp" data-wow-delay=".5s">Interdum et malesuada fames ac ante ipsum primis in
                    faucibus. <br> Donec at nulla nulla. Duis posuere ex lacus</p>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="news-card-items">
                        <div class="news-image">
                            <img src="../assets/img/news/09.jpg" alt="img">
                            <img src="../assets/img/news/09.jpg" alt="img">
                            <div class="post-box">
                                Activities
                            </div>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li>
                                    <i class="fa-light fa-calendar-days"></i>
                                    Feb 10, 2024
                                </li>
                                <li>
                                    <i class="fa-regular fa-user"></i>
                                    By Admin
                                </li>
                            </ul>
                            <h3><a href="news-details.html">Montes suspendisse massa curae malesuada</a></h3>
                            <a href="news-details.html" class="theme-btn-2">Read More <i
                                    class="fa-regular fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="news-card-items">
                        <div class="news-image">
                            <img src="../assets/img/news/10.jpg" alt="img">
                            <img src="../assets/img/news/10.jpg" alt="img">
                            <div class="post-box">
                                Activities
                            </div>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li>
                                    <i class="fa-light fa-calendar-days"></i>
                                    Mar 20, 2024
                                </li>
                                <li>
                                    <i class="fa-regular fa-user"></i>
                                    By Admin
                                </li>
                            </ul>
                            <h3><a href="news-details.html">Playful Picks Paradise: Kids' Essentials with Dash.</a></h3>
                            <a href="news-details.html" class="theme-btn-2">Read More <i
                                    class="fa-regular fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="news-card-items">
                        <div class="news-image">
                            <img src="../assets/img/news/11.jpg" alt="img">
                            <img src="../assets/img/news/11.jpg" alt="img">
                            <div class="post-box">
                                Activities
                            </div>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li>
                                    <i class="fa-light fa-calendar-days"></i>
                                    Jun 14, 2024
                                </li>
                                <li>
                                    <i class="fa-regular fa-user"></i>
                                    By Admin
                                </li>
                            </ul>
                            <h3><a href="news-details.html">Tiny Emporium: Playful Picks for Kids' Delightful Days.</a>
                            </h3>
                            <a href="news-details.html" class="theme-btn-2">Read More <i
                                    class="fa-regular fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="news-card-items">
                        <div class="news-image">
                            <img src="../assets/img/news/12.jpg" alt="img">
                            <img src="../assets/img/news/12.jpg" alt="img">
                            <div class="post-box">
                                Activities
                            </div>
                        </div>
                        <div class="news-content">
                            <ul>
                                <li>
                                    <i class="fa-light fa-calendar-days"></i>
                                    Mar 12, 2024
                                </li>
                                <li>
                                    <i class="fa-regular fa-user"></i>
                                    By Admin
                                </li>
                            </ul>
                            <h3><a href="news-details.html">Eu parturient dictumst fames quam tempor</a></h3>
                            <a href="news-details.html" class="theme-btn-2">Read More <i
                                    class="fa-regular fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section start  -->
    <?php 
        require("footer.php");
    ?>

    <!-- Newsletter Modal Area Start-->
    <div class="modal fade bd-example-modal-lg common-newsletter-modal" id="exampleModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal1 modal-bg">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="col-lg-12">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <div class="offer-modal-img d-none d-lg-block">
                                        <img src="../assets/img/cart/common-modal.jpg" alt="img">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <div class="offer-modal-right">
                                        <h3>Subcribe to Our Newsletter</h3>
                                        <p>Subscribe to our newsletter and Save your <span>20% money</span> with
                                            discount code today.</p>
                                        <form action="#!">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Enter your email">
                                                <div class="input-group-append">
                                                    <button class="theme-btn">Subscribe</button>
                                                </div>
                                            </div>
                                            <div class="check-boxed-modal">
                                                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                <label for="vehicle1">Do not show this window</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- Slider fix -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Genre slider
            var genreSwiper = new Swiper('.book-slider-genre', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.book-slider-genre .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.book-slider-genre .swiper-button-next',
                    prevEl: '.book-slider-genre .swiper-button-prev',
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        
            // Main book slider (if present)
            var mainSwiper = new Swiper('.book-slider-main', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.book-slider-main .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.book-slider-main .swiper-button-next',
                    prevEl: '.book-slider-main .swiper-button-prev',
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1200: { slidesPerView: 3 }
                }
            });
        });
        </script>
</body>

</html>

