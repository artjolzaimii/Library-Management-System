<?php
require_once("../../../utilities/config.php");

// Check if book_id is passed
if (!isset($_GET['book_id'])) {
    die("Book ID not specified.");
}

$book_id = intval($_GET['book_id']); // safely cast to int

// Fetch book details
$stmt = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();

if (!$book) {
    die("Book not found.");
}
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
    <meta name="description" content="Boimela - Books Library eCommerce Store">
    <!-- ======== Page title ============ -->
    <title>Boimela - Books Library eCommerce Store</title>
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!--<< Icomoon.css >>-->
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="assets/css/main.css">
    <?php 
        require("styleAndScripts.php");
    ?>
</head>

<body>
    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    <!-- Preloader start -->
     <div id="preloader" class="preloader">
        <div class="animation-preloader">
            <div class="spinner">
            </div>
            <div class="txt-loading">
                <span data-text-preloader="B" class="letters-loading">
                    B
                </span>
                <span data-text-preloader="O" class="letters-loading">
                    O
                </span>
                <span data-text-preloader="I" class="letters-loading">
                    I
                </span>
                <span data-text-preloader="M" class="letters-loading">
                    M
                </span>
                <span data-text-preloader="E" class="letters-loading">
                    E
                </span>
                <span data-text-preloader="L" class="letters-loading">
                    L
                </span>
                <span data-text-preloader="A" class="letters-loading">
                    A
                </span>
            </div>
            <p class="text-center">Loading</p>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back To Top start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- Offcanvas Area start  -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="index.html">
                                <img src="assets/img/logo/logo.svg" alt="logo-img">
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
                                    <a target="_blank" href="shop-details.html">Main Street, Melbourne, Australia</a>
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
                                    <a target="_blank" href="shop-details.php">Mod-friday, 09am -05pm</a>
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
                            <a href="contact.php" class="theme-btn text-center">
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

    <!-- Header Top section start -->
    <div class="header-top-section">
        <div class="container-fluid">
            <div class="header-top-wrapper">
                <ul class="contact-list">
                    <li>
                        <i class="fa-brands fa-facebook-f"></i>
                        7500k Followers
                    </li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:+40276328246">+402 763 282 46</a>
                    </li>
                </ul>
                <div class="flag-wrapper">
                    <div class="flag-wrap">
                        <div class="nice-select" tabindex="0">
                            <span class="current">
                                English
                            </span>
                            <ul class="list">
                                <li data-value="1" class="option selected focus">
                                    English
                                </li>
                                <li data-value="1" class="option">
                                    Bangla
                                </li>
                                <li data-value="1" class="option">
                                    German
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flag-wrap">
                        <div class="nice-select style-2" tabindex="0">
                            <span class="current">
                                $Usd
                            </span>
                            <ul class="list">
                                <li data-value="1" class="option selected focus">
                                    $Usd
                                </li>
                                <li data-value="1" class="option">
                                    €Eur
                                </li>
                                <li data-value="1" class="option">
                                    ¥Jpy
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="content">
                        <button id="openButton" class="account-text d-flex align-items-center gap-2">
                            <i class="fa-regular fa-user"></i>
                            Log in
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Section Start -->
    <header id="header-sticky" class="header-1">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="index.html" class="header-logo">
                            <img src="assets/img/logo/logo.svg" alt="logo-img">
                        </a>
                        <a href="index.html" class="header-logo-2 d-none">
                            <img src="assets/img/logo/logo.svg" alt="logo-img">
                        </a>
                    </div>
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li>
                                        <a href="index.html">
                                            Home
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="index.html">Home 01</a></li>
                                            <li><a href="index-2.html">Home 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="shop.php">
                                            Shop
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="shop.php">Shop Default</a></li>
                                            <li><a href="shop-list.php">Shop List</a></li>
                                            <li><a href="shop-details.php">Shop Details</a></li>
                                            <li><a href="shop-cart.php">Shop Cart</a></li>
                                            <li><a href="wishlist.php">Wishlist</a></li>
                                            <li><a href="checkout.php">Checkout</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="about.php">
                                            Pages
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="about.php">About Us</a></li>
                                            <li class="has-dropdown">
                                                <a href="team.php">
                                                    Author
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="team.html">Author</a></li>
                                                    <li><a href="team-details.php">Author Profile</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="faq.php">Faq's</a></li>
                                            <li><a href="404.php">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="news.php">
                                            Blog
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="news-grid.html">Blog Grid</a></li>
                                            <li><a href="news.html">Blog List</a></li>
                                            <li><a href="news-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">
                        <div class="search-widget">
                            <form action="#">
                                <input type="text" placeholder="Search for Products...">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <a href="#0" class="search-trigger search-icon style-2"><i
                                class="fa-regular fa-magnifying-glass"></i></a>
                        <ul class="header-icon">
                            <li>
                                <a href="#"><i class="fa-regular fa-heart"></i><span class="number">4</span></a>
                            </li>
                        </ul>
                        <div class="menu-cart">
                            <div class="cart-box">
                                <ul>
                                    <li>
                                        <img src="assets/img/shop-cart/01.png" alt="image">
                                        <div class="cart-product">
                                            <div class="cart-ctx">
                                                <a href="#">Sky Freedom</a>
                                                <span>100$</span>
                                            </div>
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li class="border-none">
                                        <img src="assets/img/shop-cart/02.png" alt="image">
                                        <div class="cart-product">
                                            <div class="cart-ctx">
                                                <a href="#">The Sky</a>
                                                <span>98$</span>
                                            </div>
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-items">
                                    <span>Total :</span>
                                    <span>$198.00</span>
                                </div>
                                <div class="cart-button mb-4">
                                    <a href="shop-cart.html" class="theme-btn">
                                        View Cart
                                    </a>
                                </div>
                            </div>
                            <a href="shop-cart.html" class="cart-icon">
                                <i class="fa-sharp fa-regular fa-bag-shopping"></i>
                            </a>
                        </div>
                        <div class="header__hamburger d-xl-none my-auto">
                            <div class="sidebar__toggle">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar Area Here -->
    <div id="targetElement" class="side_bar slideInRight side_bar_hidden">
        <div class="side_bar_overlay"></div>
        <div class="cart-title mb-50">
            <h4>Log in</h4>
        </div>
        <div class="login-sidebar">
            <form action="#" id="contact-form" method="POST">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="form-clt">
                            <span>Username or email address *</span>
                            <input type="text" name="name15" id="name15" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-clt">
                            <span>Password *</span>
                            <input id="password" type="password" placeholder="">
                            <div class="icon"><i class="fa-regular fa-eye"></i></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="theme-btn" type="submit"><span>Log In</span></button>
                    </div>
                    <div class="col-lg-12">
                        <div class="from-cheak-items">
                            <div class="form-check d-flex gap-2 from-customradio">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Remember Me
                                </label>
                            </div>
                            <p>Forgot Password?</p>
                        </div>
                    </div>
                </div>
            </form>
            <p class="text">Or login with</p>
            <div class="social-item">
                <a href="#" class="facebook-text"><img src="assets/img/facebook.png" alt="img">FACEBOOK</a>
                <a href="#" class="facebook-text google-text"><img src="assets/img/google.png" alt="img">Google</a>
            </div>
            <div class="user-icon-box">
                <img src="assets/img/user.png" alt="img">
                <p>No account yet?</p>
                <a href="account.html">Create an Account</a>
            </div>
        </div>
        <button id="closeButton" class="x-mark-icon"><i class="fas fa-times"></i></button>
    </div>

    <!-- Breadcumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>Shop Details</h1>
                <div class="page-header">
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                        <li>
                            <a href="mainPage.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <i class="fa-solid fa-chevron-right"></i>
                        </li>
                        <li>
                            Shop Details
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Details Section Start -->
    <section class="shop-details-section fix section-padding">
        <div class="container">
            <div class="shop-details-wrapper">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <div class="shop-details-image">
                            <div class="tab-content">
                                <div id="thumb1" class="tab-pane fade show active">
                                    <div class="shop-details-thumb">
                                        <img src="assets/img/shop-details/01.png" alt="img">
                                    </div>
                                </div>
                                <div id="thumb2" class="tab-pane fade">
                                    <div class="shop-details-thumb">
                                        <img src="assets/img/shop-details/02.png" alt="img">
                                    </div>
                                </div>
                                <div id="thumb3" class="tab-pane fade">
                                    <div class="shop-details-thumb">
                                        <img src="assets/img/shop-details/03.png" alt="img">
                                    </div>
                                </div>
                                <div id="thumb4" class="tab-pane fade">
                                    <div class="shop-details-thumb">
                                        <img src="assets/img/shop-details/04.png" alt="img">
                                    </div>
                                </div>
                                <div id="thumb5" class="tab-pane fade">
                                    <div class="shop-details-thumb">
                                        <img src="assets/img/shop-details/05.png" alt="img">
                                    </div>
                                </div>
                            </div>
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="#thumb1" data-bs-toggle="tab" class="nav-link active">
                                        <img src="assets/img/shop-details/sm-1.png" alt="img">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#thumb2" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/shop-details/sm-2.png" alt="img">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#thumb3" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/shop-details/sm-3.png" alt="img">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#thumb4" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/shop-details/sm-4.png" alt="img">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#thumb5" data-bs-toggle="tab" class="nav-link">
                                        <img src="assets/img/shop-details/sm-5.png" alt="img">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="shop-details-content">
                            <div class="title-wrapper">
                                <h2><?= htmlspecialchars($book['title']) ?></h2>

                                <h5>Stock availability.</h5>
                            </div>
                            <div class="star">
                                <a href="shop-details.php"> <i class="fas fa-star"></i></a>
                                <a href="shop-details.php"><i class="fas fa-star"></i></a>
                                <a href="shop-details.php"> <i class="fas fa-star"></i></a>
                                <a href="shop-details.php"><i class="fas fa-star"></i></a>
                                <a href="shop-details.php"><i class="fa-regular fa-star"></i></a>
                                <span>(1 Customer Reviews)</span>
                            </div>
                            <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>

                            <div class="price-list">
                                <h3>$<?= number_format($book['price'], 2) ?></h3>

                            </div>
                            <div class="cart-wrapper">
                                <div class="quantity-basket">
                                    <p class="qty">
                                        <button class="qtyminus" aria-hidden="true">−</button>
                                        <input type="number" name="qty" id="qty2" min="1" max="10" step="1" value="1">
                                        <button class="qtyplus" aria-hidden="true">+</button>
                                    </p>
                                </div>
                                <button type="button" class="theme-btn style-2" data-bs-toggle="modal"
                                    data-bs-target="#readMoreModal">
                                    Read A little
                                </button>
                                <!-- Read More Modal -->
                                <div class="modal fade" id="readMoreModal" tabindex="-1"
                                    aria-labelledby="readMoreModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body"
                                                style="background-image: url(assets/img/popupBg.png);">
                                                <div class="close-btn">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="readMoreBox">
                                                    <div class="content">
                                                        <h3 id="readMoreModalLabel">The Role Of Book</h3>
                                                        <p>
                                                            Educating the Public <br>
                                                            Political books play a crucial role in educating the public
                                                            about political theories, historical events, policies, and
                                                            the workings of governments. They provide readers with
                                                            insights into complex political concepts and the historical
                                                            context behind current events, helping to foster a more
                                                            informed citizenry. <br><br>

                                                            Shaping Public Opinion <br>
                                                            Authors of political books often aim to influence public
                                                            opinion by presenting arguments and perspectives on various
                                                            issues. These books can sway readers' views, either
                                                            reinforcing their existing beliefs or challenging them to
                                                            consider alternative viewpoints. This influence can extend
                                                            to political debates and discussions in the public sphere.
                                                            <br><br>

                                                            Documenting History <br>
                                                            Political books serve as valuable records of historical
                                                            events and political movements. They document the thoughts,
                                                            actions, and decisions of political leaders and activists,
                                                            providing future generations with a detailed account of
                                                            significant periods and events. This historical
                                                            documentation is essential for understanding the evolution
                                                            of political systems and ideologies.

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="shop-details.php" class="theme-btn">Add To Cart</a>
                                <div class="icon-box">
                                    <a href="shop-details.php" class="icon">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    <a href="shop-details.php" class="icon-2">
                                        <img src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                    </a>
                                </div>
                            </div>
                            <div class="category-box">
    <div class="category-list">
        <ul>
            <li>
                <span>SKU:</span> <?= htmlspecialchars($book['isbn']) ?>
            </li>
            <li>
                <span>Category:</span> <?= htmlspecialchars($book['category'] ?? 'N/A') ?>
            </li>
        </ul>
        <ul>
            <li>
                <span>Tags:</span> <?= htmlspecialchars($book['tags'] ?? 'General') ?>
            </li>
            <li>
                <span>Format:</span> <?= htmlspecialchars($book['format']) ?>
            </li>
        </ul>
        <ul>
            <li>
                <span>Total page:</span> <?= htmlspecialchars($book['nr_pages']) ?>
            </li>
            <li>
                <span>Language:</span> <?= htmlspecialchars($book['language']) ?>
            </li>
        </ul>
        <ul>
            <li>
                <span>Publish Years:</span> <?= htmlspecialchars($book['publication_year']) ?>
            </li>
            <li>
                <span>Century:</span> <?= htmlspecialchars($book['country'] ?? 'Unknown') ?>
            </li>
        </ul>
    </div>
</div>

<div class="box-check">
    <div class="check-list">
        <ul>
            <li>
                <i class="fa-solid fa-check"></i>
                Free shipping orders from $150
            </li>
            <li>
                <i class="fa-solid fa-check"></i>
                30 days exchange & return
            </li>
        </ul>
        <ul>
            <li>
                <i class="fa-solid fa-check"></i>
                Mamaya Flash Discount: Starting at 30% Off
            </li>
            <li>
                <i class="fa-solid fa-check"></i>
                Safe & Secure online shopping
            </li>
        </ul>
    </div>
</div>

                            <div class="social-icon">
                                <h6>Also Available On:</h6>
                                <a href="https://www.customer.io/"><img src="assets/img/cutomerio.png"
                                        alt="cutomer.io"></a>
                                <a href="https://www.amazon.com/"><img src="assets/img/amazon.png" alt="amazon"></a>
                                <a href="https://www.dropbox.com/"><img src="assets/img/dropbox.png" alt="dropbox"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-tab section-padding pb-0">
                    <ul class="nav mb-5" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#description" data-bs-toggle="tab" class="nav-link ps-0 active"
                                aria-selected="true" role="tab">
                                <h6>Description</h6>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#additional" data-bs-toggle="tab" class="nav-link" aria-selected="false"
                                tabindex="-1" role="tab">
                                <h6>Additional Information </h6>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#review" data-bs-toggle="tab" class="nav-link" aria-selected="false" tabindex="-1"
                                role="tab">
                                <h6>reviews (3)</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="description" class="tab-pane fade show active" role="tabpanel">
                            <div class="description-items">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis erat
                                    interdum, tempor turpis in, sodales ex. In hac habitasse platea dictumst. Etiam
                                    accumsan scelerisque urna, a lobortis velit vehicula ut. Maecenas porttitor dolor a
                                    velit aliquet, et euismod nibh vulputate. Duis nunc velit, lacinia vel risus in,
                                    finibus sodales augue. Aliquam lacinia imperdiet dictum. Etiam tempus finibus
                                    tortor, quis placerat arcu tristique in. Sed vitae dui a diam luctus maximus.
                                    Quisque nec felis dapibus, dapibus enim vitae, vestibulum libero. Aliquam erat
                                    volutpat. Phasellus luctus rhoncus justo. Duis a nulla sit amet justo aliquam
                                    ullamcorper. Phasellus nulla lorem, pretium et libero in, porta auctor dui. In a
                                    ornare purus, et efficitur elit. Etiam consectetur sit amet quam ut tincidunt. Donec
                                    gravida ultricies tellus ac pharetra.
                                    Praesent a pulvinar purus. Proin sollicitudin leo eget mi sagittis aliquam. Donec
                                    sollicitudin ex ac lobortis mollis. Sed eget libero nec mi
                                </p>
                            </div>
                        </div>
                        <div id="additional" class="tab-pane fade" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-1">Availability</td>
                                            <td class="text-2">Available</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Categories</td>
                                            <td class="text-2">Adventure</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Publish Date</td>
                                            <td class="text-2">2022-10-24</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Total Page</td>
                                            <td class="text-2">330</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Format</td>
                                            <td class="text-2">Hardcover</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Country</td>
                                            <td class="text-2">United States</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Language</td>
                                            <td class="text-2">English</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Dimensions</td>
                                            <td class="text-2">30 × 32 × 46 Inches</td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Weight</td>
                                            <td class="text-2">2.5 Pounds</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="review" class="tab-pane fade" role="tabpanel">

  <div class="review-items">
    <?php
    $book_id = $_GET['book_id'];
    $reviewQuery = $conn->prepare("SELECT * FROM reviews WHERE book_id = ?");
    $reviewQuery->bind_param("i", $book_id);
    $reviewQuery->execute();
    $reviews = $reviewQuery->get_result();
    while ($r = $reviews->fetch_assoc()):
    ?>
      <div class="review-wrap-area d-flex gap-4">
        <div class="review-thumb">
          <img src="assets/img/shop-details/review.png" alt="img">
        </div>
        <div class="review-content">
          <div class="head-area d-flex flex-wrap gap-2 align-items-center justify-content-between">
            <div class="cont">
              <h5><?= htmlspecialchars($r['name']) ?></h5>
            <span>
  <?= isset($r['created_at']) ? date("F d, Y h:i a", strtotime($r['created_at'])) : 'Unknown date' ?>
</span>

            </div>
            <div class="star">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <i class="<?= $i <= $r['rating'] ? 'fa-solid' : 'fa-regular' ?> fa-star"></i>
              <?php endfor; ?>
            </div>
          </div>
          <p class="mt-30 mb-4"><?= nl2br(htmlspecialchars($r['message'])) ?></p>
        </div>
      </div>
    <?php endwhile; ?>

    <!-- Review Submission Form -->
    <div class="review-title mt-5 py-15 mb-30">
      <h4>Submit Your Review</h4>
    </div>
    <div class="review-form">
      <form action="submit-review.php" method="POST">
        <input type="hidden" name="book_id" value="<?= $book_id ?>">
        <div class="row g-4">
          <div class="col-lg-6">
            <input type="text" name="name" placeholder="Your Name" required>
          </div>
          <div class="col-lg-6">
            <input type="email" name="email" placeholder="Your Email" required>
          </div>
          <div class="col-lg-12">
            <textarea name="message" placeholder="Write Message" required></textarea>
          </div>
          <div class="col-lg-12">
            <select name="rating" required class="form-select">
              <option value="">Select Rating</option>
              <option value="5">★★★★★</option>
              <option value="4">★★★★☆</option>
              <option value="3">★★★☆☆</option>
              <option value="2">★★☆☆☆</option>
              <option value="1">★☆☆☆☆</option>
            </select>
          </div>
          <div class="col-lg-12">
            <button type="submit" class="theme-btn style-2">Submit now</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>





                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Ratting Book Section Start -->
    <section class="top-ratting-book-section fix">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="mb-3 wow fadeInUp" data-wow-delay=".3s">Related Products</h2>
                <p class="wow fadeInUp" data-wow-delay=".5s">
                    Interdum et malesuada fames ac ante ipsum primis in faucibus. <br> Donec at nulla nulla. Duis
                    posuere ex lacus
                </p>
            </div>
            <div class="swiper book-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="assets/img/book/01.png" alt="img"></a>
                                <ul class="post-box">
                                    <li>
                                        Hot
                                    </li>
                                    <li>
                                        -30%
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">

                                            <img class="icon" src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
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
                                            <img src="assets/img/testimonial/client-1.png" alt="img">
                                        </span>
                                        <span class="content">Wilson</span>
                                    </li>

                                    <li class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="assets/img/book/02.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">

                                            <img class="icon" src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
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
                                            <img src="assets/img/testimonial/client-2.png" alt="img">
                                        </span>
                                        <span class="content">Alexander</span>
                                    </li>

                                    <li class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="assets/img/book/03.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">

                                            <img class="icon" src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
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
                                            <img src="assets/img/testimonial/client-3.png" alt="img">
                                        </span>
                                        <span class="content">Esther</span>
                                    </li>

                                    <li class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="assets/img/book/04.png" alt="img"></a>
                                <ul class="post-box">
                                    <li>
                                        Hot
                                    </li>
                                </ul>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">

                                            <img class="icon" src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
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
                                            <img src="assets/img/testimonial/client-4.png" alt="img">
                                        </span>
                                        <span class="content">Hawkins</span>
                                    </li>

                                    <li class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="shop-details"><img src="assets/img/book/05.png" alt="img"></a>
                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                    <li>
                                        <a href="shop-cart.html"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="shop-cart.html">

                                            <img class="icon" src="assets/img/icon/shuffle.svg" alt="svg-icon">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
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
                                            <img src="assets/img/testimonial/client-5.png" alt="img">
                                        </span>
                                        <span class="content">(Author) Albert</span>
                                    </li>

                                    <li class="star">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="shop-details.html" class="theme-btn">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section start  -->
    <footer class="footer-section fix">
        <div class="container">
            <div class="footer-widget-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-4 wow fadeInUp" data-wow-delay=".2s">
                        <div class="single-footer-widget">
                            <div class="widget-head"><a href="index.html" class="footer-logo">
                                    <img src="assets/img/logo/logo.svg" alt="logo-img">
                                </a>
                            </div>
                            <div class="footer-content">
                                <div class="text">
                                    <p>Got Questions? Call us</p>
                                    <a href="tel:+67041390762">+670 413 90 762</a>
                                </div>
                                <ul class="contact-list">
                                    <li>
                                        <i class="fa-regular fa-envelope"></i>
                                        <a href="mailto:readit@gmail.com">readit@gmail.com</a>
                                    </li>
                                    <li>
                                        <i class="fa-regular fa-location-dot"></i>
                                        79 Sleepy Hollow St.<br>
                                        Jamaica, New York 1432
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Costumers Support</h3>
                            </div>
                            <ul class="list-items">
                                <li>
                                    <a href="shop.html">
                                        Store List
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        Opening Hours
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        Contact Us
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        Return Policy
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4 ps-lg-5 wow fadeInUp" data-wow-delay=".6s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Categories</h3>
                            </div>
                            <ul class="list-items">
                                <li>
                                    <a href="contact.html">
                                        Novel Books
                                    </a>
                                </li>
                                <li>
                                    <a href="shop.html">
                                        Poetry Books
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        Political Books
                                    </a>
                                </li>
                                <li>
                                    <a href="contact.html">
                                        History Books
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                        <div class="single-footer-widget">
                            <div class="widget-head">
                                <h3>Subcribe.</h3>
                            </div>
                            <div class="footer-content">
                                <p class="f-text">Our conversation is just getting started</p>
                                <div class="footer-input">
                                    <input type="email" id="email2" placeholder="Enter Your Email">
                                    <button class="newsletter-btn" type="submit">
                                        <span>Subscribe</span>
                                    </button>
                                </div>
                                <div class="social-item">
                                    <h6>Follow Us On</h6>
                                    <div class="social-icon d-flex align-items-center">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fa-brands fa-vimeo-v"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-wrapper">
                    <p class="wow fadeInUp" data-wow-delay=".3s">
                        ©All Rights reserved 2025 by <span>Readit.</span>
                    </p>
                    <div class="bottom-list wow fadeInUp" data-wow-delay=".5s">
                        <div class="app-image">
                            <img src="assets/img/footer/01.png" alt="img">
                        </div>
                        <div class="app-image">
                            <img src="assets/img/footer/02.png" alt="img">
                        </div>
                        <div class="app-image">
                            <img src="assets/img/footer/03.png" alt="img">
                        </div>
                        <div class="app-image">
                            <img src="assets/img/footer/04.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

 <!--<< All JS Plugins >>-->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!--<< Viewport Js >>-->
    <script src="assets/js/viewport.jquery.js"></script>
    <!--<< Bootstrap Js >>-->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--<< Nice Select Js >>-->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!--<< Waypoints Js >>-->
    <script src="assets/js/jquery.waypoints.js"></script>
    <!--<< Counterup Js >>-->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!--<< MeanMenu Js >>-->
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <!--<< Magnific Popup Js >>-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!--<< Wow Animation Js >>-->
    <script src="assets/js/wow.min.js"></script>
    <!-- Gsap -->
    <script src="assets/js/gsap.min.js"></script>
    <!--<< Main.js >>-->
    <script src="assets/js/main.js"></script> 
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
