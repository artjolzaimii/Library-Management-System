<?php 
    include("clientMenu.php");
    require_once("../../../utilities/config.php");
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
    <meta name="description" content="EternaLibrary - Books Library eCommerce Store">
    <!-- ======== Page title ============ -->
    <title>Eterna Library - Books Library eCommerce Store</title>
    
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
                <div class="swiper-slide">
                    <div class="banner-book-card-items bg-cover" style="background-image: url('../assets/img/banner/book-banner-1.jpg');">
                        <div class="book-shape">
                            <img src="../assets/img/banner/book-1.png" alt="img">
                        </div>
                        <div class="banner-book-content">
                            <div class="banner-text">
                                <span>25% off</span>
                                <h2>Romantic Novels</h2>
                                <p>Fall in love with these classic stories</p>
                            </div>
                            <a href="#shop-section" class="banner-icons" onclick="loadBooksByGenre('drama'); return false;">
                                <img src="../assets/img/icon/icon-25.svg" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="swiper-slide">
                    <div class="banner-book-card-items bg-cover" style="background-image: url('../assets/img/banner/book-banner-1.jpg');">
                        <div class="book-shape">
                            <img src="../assets/img/banner/book-2.png" alt="img">
                        </div>
                        <div class="banner-book-content">
                            <div class="banner-text">
                                <span>25% off</span>
                                <h2>Drama Novels</h2>
                                <p>Fall in love with these classic stories</p>
                            </div>
                            <a href="#shop-section" class="banner-icons" onclick="window.location.href='mainPage.php?genre=drama'">
                                <img src="../assets/img/icon/icon-25.svg" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="swiper-slide">
                    <div class="banner-book-card-items bg-cover" style="background-image: url('../assets/img/banner/book-banner-1.jpg');">
                        <div class="book-shape">
                            <img src="../assets/img/banner/book-3.png" alt="img">
                        </div>
                        <div class="banner-book-content">
                            <div class="banner-text">
                                <span>25% off</span>
                                <h2>Romantic Novels</h2>
                                <p>Fall in love with these classic stories</p>
                            </div>
                            <a href="#shop-section" class="banner-icons" onclick="loadBooksByGenre('Romantic Novels'); return false;">
                                <img src="../assets/img/icon/icon-25.svg" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                
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
            <a href="shop.html" class="theme-btn style-2">Explore More <i class="fa-solid fa-arrow-right-long"></i></a>
        </div>
        <div class="swiper book-slider-genre" id="shop-books-container">
            <div class="swiper-wrapper">
                <?php 
                if ($result && $result->num_rows > 0) {
                    while ($book = $result->fetch_assoc()) {
                        $img = !empty($book['image_path']) ? $book['image_path'] : '../assets/img/book/01.png';
                        $author = "Author Unknown"; 
                        $price = "$20.00"; 
                        $old_price = "$30.00";

                        echo '
                            <div class="swiper-slide">
                                <div class="shop-box-items style-2">
                                    <div class="book-thumb center">
                                        <a href="shop-details.php?book_id=' . $book['book_id'] . '">
                                            <img src="../../../uploads/images/' . htmlspecialchars($img) . '" alt="img">
                                        </a>
                                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                                            <li><a href="shop-cart.html"><i class="far fa-heart"></i></a></li>
                                            <li><a href="shop-cart.html"><img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon"></a></li>
                                            <li><a href="shop-details.php?book_id=' . $book['book_id'] . '"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                        <div class="shop-button">
                                            <a href="shop-details.php?book_id=' . $book['book_id'] . '" class="theme-btn">Add To Cart</a>
                                        </div>
                                    </div>
                                    <div class="shop-content">
                                        <h5>Design Low Book</h5>
                                        <h3><a href="shop-details.php?book_id=' . $book['book_id'] . '">' . htmlspecialchars($book['title'] ?? 'No Title') . '</a></h3>
                                        <ul class="price-list">
                                            <li>$' . htmlspecialchars($book['price'] ?? '20.00') . '</li>
                                            <li><del>$' . htmlspecialchars($book['old_price'] ?? '30.00') . '</del></li>
                                        </ul>
                                        <ul class="author-post">
                                            <li class="authot-list">
                                                <span class="thumb"><img src="../assets/img/testimonial/client-1.png" alt="img"></span>
                                                <span class="content">' . htmlspecialchars($book['author'] ?? 'Author Unknown') . '</span>
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
                ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    </section>
    
    <!-- JS for AJAX genre load -->
    <script>
        function loadBooksByGenre(genre) {
            const container = document.getElementById('shop-books-container');
        
            // Change URL without reloading
            const params = new URLSearchParams(window.location.search);
            params.set('genre', genre);
            history.pushState({}, '', window.location.pathname + '?' + params.toString());
        
            // Show loading spinner
            container.innerHTML = '<div style="padding:2rem;text-align:center;">Loading...</div>';
        
            // AJAX call
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'mainPage.php?genre=' + encodeURIComponent(genre), true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    container.innerHTML = xhr.responseText;
        
                    // Destroy old swiper
                    if (window.genreSwiper) window.genreSwiper.destroy(true, true);
        
                    // Init new swiper
                    window.genreSwiper = new Swiper('.book-slider-genre', {
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
                } else {
                    container.innerHTML = '<p class="text-danger">Error loading books.</p>';
                }
            };
            xhr.onerror = function () {
                container.innerHTML = '<p class="text-danger">Network error.</p>';
            };
            xhr.send();
        
            // Scroll into view
            document.getElementById('shop-section').scrollIntoView({ behavior: 'smooth' });
        }
        


    </script>
   
    <!-- Shop Section Start -->
    <section class="shop-section section-padding fix pt-0">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Top Category Books</h2>
                </div>
                <a href="shop.html" class="theme-btn style-2 wow fadeInUp" data-wow-delay=".5s">Explore More <i
                        class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="swiper book-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/01.png" alt="img"></a>
                                <ul class="post-box">
                                    <li>
                                        Hot
                                    </li>
                                    <li class="style-2">
                                        -30%
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                 <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">Simple Things You To <br> Save BOOK</a></h3>
                                <ul class="price-list">
                                    <li>$30.00</li>
                                    <li>
                                        <del>$39.99</del>
                                    </li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-1.png" alt="img">
                                        </span>
                                        <span class="content">Wilson</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/02.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">How Deal With Very <br> Bad BOOK</a></h3>
                                <ul class="price-list">
                                    <li>$39.00</li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-2.png" alt="img">
                                        </span>
                                        <span class="content">Esther</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/03.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">The Hidden Mystery <br> Behind</a></h3>
                                <ul class="price-list">
                                    <li>
                                        $29.00
                                    </li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-3.png" alt="img">
                                        </span>
                                        <span class="content">Hawkins</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/04.png" alt="img"></a>
                                <ul class="post-box">
                                    <li class="style-2">
                                        -12%
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                                <ul class="price-list">
                                    <li>$19.00</li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-4.png" alt="img">
                                        </span>
                                        <span class="content">(Author) Albert </span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/05.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">Flovely and Unicom <br> Erna</a></h3>
                                <ul class="price-list">
                                    <li>$30.00</li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-5.png" alt="img">
                                        </span>
                                        <span class="content">Alexander</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Books Section Start -->
    <section class="featured-books-section pt-100 pb-145 fix section-bg">
        <div class="container">
            <div class="section-title-area justify-content-center">
                <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                    <h2>Featured Books</h2>
                </div>
            </div>

            <div class="swiper featured-books-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-box-items style-4 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/07.png" alt="img"></a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                    <li class="book-category-badge">Adventure</li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        (459)
                                    </li>
                                </ul>
                                <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-1.png" alt="img">
                                        </span>
                                        <span class="content">Wilson</span>
                                    </li>
                                </ul>
                                <div class="book-availablity">
                                    <div class="details">
                                        <ul class="price-list">
                                            <li>$30.00</li>
                                            <li>
                                                <del>$39.99</del>
                                            </li>
                                        </ul>
                                        <div class="progress-line">

                                        </div>
                                        <p>25 Books in stock</p>
                                    </div>
                                    <div class="shop-btn">
                                        <a href="shop-cart.html">
                                            <i class="fa-regular fa-basket-shopping"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-4 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/11.png" alt="img"></a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                    <li class="book-category-badge">Adventure</li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        (459)
                                    </li>
                                </ul>
                                <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-2.png" alt="img">
                                        </span>
                                        <span class="content">Hawkins</span>
                                    </li>
                                </ul>
                                <div class="book-availablity">
                                    <div class="details">
                                        <ul class="price-list">
                                            <li>$30.00</li>
                                            <li>
                                                <del>$39.99</del>
                                            </li>
                                        </ul>
                                        <div class="progress-line">

                                        </div>
                                        <p>25 Books in stock</p>
                                    </div>
                                    <div class="shop-btn">
                                        <a href="shop-cart.html">
                                            <i class="fa-regular fa-basket-shopping"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-4 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/10.png" alt="img"></a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                    <li class="book-category-badge">Adventure</li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        (459)
                                    </li>
                                </ul>
                                <h3><a href="shop-details.html">The Hidden Mystery <br> Behind</a></h3>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-3.png" alt="img">
                                        </span>
                                        <span class="content">Esther</span>
                                    </li>
                                </ul>
                                <div class="book-availablity">
                                    <div class="details">
                                        <ul class="price-list">
                                            <li>$30.00</li>
                                            <li>
                                                <del>$39.99</del>
                                            </li>
                                        </ul>
                                        <div class="progress-line">

                                        </div>
                                        <p>25 Books in stock</p>
                                    </div>
                                    <div class="shop-btn">
                                        <a href="shop-cart.html">
                                            <i class="fa-regular fa-basket-shopping"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-4 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/07.png" alt="img"></a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                    <li class="book-category-badge">Adventure</li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        (459)
                                    </li>
                                </ul>
                                <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-1.png" alt="img">
                                        </span>
                                        <span class="content">Wilson</span>
                                    </li>
                                </ul>
                                <div class="book-availablity">
                                    <div class="details">
                                        <ul class="price-list">
                                            <li>$30.00</li>
                                            <li>
                                                <del>$39.99</del>
                                            </li>
                                        </ul>
                                        <div class="progress-line">

                                        </div>
                                        <p>25 Books in stock</p>
                                    </div>
                                    <div class="shop-btn">
                                        <a href="shop-cart.html">
                                            <i class="fa-regular fa-basket-shopping"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-4 wow fadeInUp" data-wow-delay=".2s">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/11.png" alt="img"></a>
                            </div>
                            <div class="shop-content">
                                <ul class="book-category">
                                    <li class="book-category-badge">Adventure</li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        (459)
                                    </li>
                                </ul>
                                <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-2.png" alt="img">
                                        </span>
                                        <span class="content">Hawkins</span>
                                    </li>
                                </ul>
                                <div class="book-availablity">
                                    <div class="details">
                                        <ul class="price-list">
                                            <li>$30.00</li>
                                            <li>
                                                <del>$39.99</del>
                                            </li>
                                        </ul>
                                        <div class="progress-line">

                                        </div>
                                        <p>25 Books in stock</p>
                                    </div>
                                    <div class="shop-btn">
                                        <a href="shop-cart.html">
                                            <i class="fa-regular fa-basket-shopping"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Best Seller Section Start -->
    <section class="best-seller-section section-padding fix">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                    <h2>Best Sellers</h2>
                </div>
                <a href="shop.html" class="theme-btn style-2 wow fadeInUp" data-wow-delay=".5s">Explore More <i
                        class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="book-shop-wrapper style-2">
                <div class="shop-box-items style-3 wow fadeInUp" data-wow-delay=".2s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/07.png" alt="img"></a>
                    </div>
                    <div class="shop-content">
                        <ul class="book-category">
                            <li class="book-category-badge">Adventure</li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                        <h3><a href="shop-details.html">The Hidden Mystery <br> Behind</a></h3>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="content">Wilson</span>
                            </li>
                        </ul>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="shop-box-items style-3 wow fadeInUp" data-wow-delay=".4s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/08.png" alt="img"></a>
                    </div>
                    <div class="shop-content">
                        <ul class="book-category">
                            <li class="book-category-badge">Adventure</li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                        <h3><a href="shop-details.html">Qple GPad With <br> Retina Sisplay </a></h3>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="content">Wilson</span>
                            </li>
                        </ul>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                </div>
                <div class="shop-box-items style-3 wow fadeInUp" data-wow-delay=".6s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/09.png" alt="img"></a>
                    </div>
                    <div class="shop-content">
                        <ul class="book-category">
                            <li class="book-category-badge">Adventure</li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                        <h3><a href="shop-details.html">Simple Things You <br> To Save BOOK </a></h3>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="content">Wilson</span>
                            </li>
                        </ul>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Section Start -->
    <section class="feature-section fix section-padding pt-0">
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

    <!-- Shop Section Start -->
    <section class="shop-section section-padding fix pt-0">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                    <h2>Discover Your Favorite Author Books</h2>
                </div>
                <a href="shop.html" class="theme-btn style-2 wow fadeInUp" data-wow-delay=".5s">Explore More <i
                        class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="book-shop-wrapper">
                <div class="shop-box-items style-2 wow fadeInUp" data-wow-delay=".2s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/03.png" alt="img"></a>
                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                            <li>
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </li>
                            <li>
                                <a href="shop-cart.html">
                                    <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                </a>
                            </li>
                            <li>
                                <a href="shop-details.html"><i class="far fa-eye"></i></a>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                    <div class="shop-content">
                        <h5> Design Low Book </h5>
                        <h3><a href="shop-details.html">The Hidden Mystery <br> Behind</a></h3>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="thumb">
                                    <img src="../assets/img/testimonial/client-1.png" alt="img">
                                </span>
                                <span class="content">Wilson</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="shop-box-items style-2 wow fadeInUp" data-wow-delay=".3s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/02.png" alt="img"></a>
                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                            <li>
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </li>
                            <li>
                                <a href="shop-cart.html">
                                    <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                </a>
                            </li>
                            <li>
                                <a href="shop-details.html"><i class="far fa-eye"></i></a>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                    <div class="shop-content">
                        <h5> Design Low Book </h5>
                        <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="thumb">
                                    <img src="../assets/img/testimonial/client-2.png" alt="img">
                                </span>
                                <span class="content">Hawkins</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="shop-box-items style-2 wow fadeInUp" data-wow-delay=".4s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/04.png" alt="img"></a>
                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                            <li>
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </li>
                            <li>
                                <a href="shop-cart.html">
                                    <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                </a>
                            </li>
                            <li>
                                <a href="shop-details.html"><i class="far fa-eye"></i></a>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                    <div class="shop-content">
                        <h5> Design Low Book </h5>
                        <h3><a href="shop-details.html">Flovely and Unicom <br> Erna</a></h3>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="thumb">
                                    <img src="../assets/img/testimonial/client-3.png" alt="img">
                                </span>
                                <span class="content">Esther</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="shop-box-items style-2 wow fadeInUp" data-wow-delay=".5s">
                    <div class="book-thumb center">
                        <a href="shop-details"><img src="../assets/img/book/05.png" alt="img"></a>
                        <ul class="post-box">
                            <li class="style-2">
                                -30%
                            </li>
                        </ul>
                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                            <li>
                                <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                            </li>
                            <li>
                                <a href="shop-cart.html">
                                    <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                </a>
                            </li>
                            <li>
                                <a href="shop-details.html"><i class="far fa-eye"></i></a>
                            </li>
                        </ul>
                        <div class="shop-button">
                            <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                        </div>
                    </div>
                    <div class="shop-content">
                        <h5> Design Low Book </h5>
                        <h3><a href="shop-details.html">How Deal With Very <br> Bad BOOK</a></h3>
                        <ul class="price-list">
                            <li>$30.00</li>
                            <li>
                                <del>$39.99</del>
                            </li>
                        </ul>
                        <ul class="author-post">
                            <li class="authot-list">
                                <span class="thumb">
                                    <img src="../assets/img/testimonial/client-4.png" alt="img">
                                </span>
                                <span class="content">(Author) Albert</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                3.4 (25)
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cta-shop-box">
                    <div class="boy-shape">
                        <img src="../assets/img/boy-shape.png" alt="shape-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cta Banner Section Start -->
    <section class="cta-banner-section fix section-padding pt-0">
        <div class="container">
            <div class="cta-banner-wrapper-2 section-padding bg-cover"
                style="background-image: url('../assets/img/cta-banner-2.jpg');">
                <div class="cta-content-wrappers">
                    <div class="cta-texts">
                        <span class="wow fadeInUp">Get 25% </span>
                        <h2 class="text-white mb-40 wow fadeInUp" data-wow-delay=".3s">discount in all<br> kind of
                            super Selling</h2>
                    </div>
                    <div class="ctx-btn">
                        <a href="shop.html" class="theme-btn white-bg wow fadeInUp" data-wow-delay=".5s">
                            Shop Now <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop Section Start -->
    <section class="shop-section section-padding fix pt-0">
        <div class="container">
            <div class="section-title-area">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Pick Your Favorite Books</h2>
                </div>
                <a href="shop.html" class="theme-btn style-2 wow fadeInUp" data-wow-delay=".5s">Explore More <i
                        class="fa-solid fa-arrow-right-long"></i></a>
            </div>
            <div class="swiper book-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/01.png" alt="img"></a>
                                <ul class="post-box">
                                    <li>
                                        Hot
                                    </li>
                                    <li class="style-2">
                                        -30%
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">Simple Things You To <br> Save BOOK</a></h3>
                                <ul class="price-list">
                                    <li>$30.00</li>
                                    <li>
                                        <del>$39.99</del>
                                    </li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-1.png" alt="img">
                                        </span>
                                        <span class="content">Wilson</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/02.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">How Deal With Very <br> Bad BOOK</a></h3>
                                <ul class="price-list">
                                    <li>$39.00</li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-2.png" alt="img">
                                        </span>
                                        <span class="content">Esther</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/03.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">The Hidden Mystery <br> Behind</a></h3>
                                <ul class="price-list">
                                    <li>
                                        $29.00
                                    </li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-3.png" alt="img">
                                        </span>
                                        <span class="content">Hawkins</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/04.png" alt="img"></a>
                                <ul class="post-box">
                                    <li>
                                        -12%
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">Qple GPad With Retina <br> Sisplay</a></h3>
                                <ul class="price-list">
                                    <li>$19.00</li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-4.png" alt="img">
                                        </span>
                                        <span class="content">(Author) Albert </span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="../assets/img/book/05.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">
                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                                <div class="shop-button">
                                    <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                                </div>
                            </div>
                            <div class="shop-content">
                                <h5> Design Low Book </h5>
                                <h3><a href="shop-details.html">Flovely and Unicom <br> Erna</a></h3>
                                <ul class="price-list">
                                    <li>$30.00</li>
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../assets/img/testimonial/client-5.png" alt="img">
                                        </span>
                                        <span class="content">Alexander</span>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        3.4 (25)
                                    </li>
                                </ul>
                            </div>
                        </div>
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
    
    <section class="team-section fix section-padding pt-0 margin-bottom-30">
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
                            <h3><a href="news-details.html">Playful Picks Paradise: Kids’ Essentials with Dash.</a></h3>
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
                            <h3><a href="news-details.html">Tiny Emporium: Playful Picks for Kids’ Delightful Days.</a>
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