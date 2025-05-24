<?php 
    require_once("./clientmenu.php");
    require_once("../../../utilities/config1.php");
    if(isset($_GET['authorId'])){
        $authorId=mysqli_real_escape_string($conn,$_GET['authorId']);
        $query="SELECT a.full_name, bio, nationality, birth_year, death_year, image_path, COUNT(a.author_id) as nr_books
                FROM author a LEFT JOIN book_author ba ON a.author_id=ba.author_id
                WHERE a.author_id=?
                GROUP BY a.author_id";
                
        $stm=mysqli_prepare($conn,$query);    
        $stm->bind_param("i",$authorId);
        $stm->execute();
        $result=$stm->get_result();
        
        if($result->num_rows==1){
            $author=$result->fetch_assoc();    
        }
        else{
            echo "<style>window.location.href='mainPage.php'</style>";
        }
    }
    else{
        echo "<style>window.location.href='mainPage.php'</style>";
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
    <meta name="description" content="Eternal Library- Books Library eCommerce Store">
    <!-- ======== Page title ============ -->
    <title>Eternal Library - Books Library eCommerce Store</title>

    <?php 
        require_once("./styleAndScripts.php");
    ?>
</head>

<body>
    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    <!-- Preloader start -->
    <?php 
        include("./loading.php");
    ?>

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
                                    <a target="_blank" href="team-details.html">Main Street, Melbourne, Australia</a>
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
                                    <a target="_blank" href="team-details.html">Mod-friday, 09am -05pm</a>
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

    <!-- Sidebar Area Here -->
    <?php 
        include("./logInSidebar.php");
    ?>

    <!-- Breadcumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>Author Profile</h1>
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
                            Author Profile
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Team Details Section Start -->
    <section class="team-details-section fix section-padding">
        <div class="container">
            <div class="team-details-wrapper">
                <div class="team-details-items">
                    <div class="details-image wow fadeInUp" data-wow-delay=".3s">
                        <img src="../../../<?php echo $author['image_path']?>" alt="img">
                    </div>
                    <div class="details-content wow fadeInUp" data-wow-delay=".5s">
                        <h3>Author: <?php echo $author['full_name']?></h3>
                        <span><?php echo $author['nationality']?></span>
                    </div>
                </div>
                <p class="wow fadeInUp" data-wow-delay=".7s">
                    <?php echo $author['bio']?>
                </p>
                <div class="details-counter-area">
                    <div class="counter-items wow fadeInUp" data-wow-delay=".3s">
                        <h2><span class="count"><?php echo $author['nr_books'] ?></span>+</h2>
                        <p>Books</p>
                    </div>
                    <div class="counter-items wow fadeInUp" data-wow-delay=".5s">
                        <h2><span class="count">100</span>+</h2>
                        <p>Seles</p>
                    </div>
                    <div class="counter-items wow fadeInUp" data-wow-delay=".7s">
                        <h2><span class="count">90</span>+</h2>
                        <p>Review</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    //Fetch author's books
    $booksQuery = "SELECT b.*, sb.price 
                FROM book b 
                JOIN book_author ba ON b.book_id = ba.book_id 
                LEFT JOIN sale_book sb ON b.book_id = sb.book_id 
                WHERE ba.author_id = ?";
    $booksStmt = mysqli_prepare($conn, $booksQuery);
    $booksStmt->bind_param("i", $authorId);
    $booksStmt->execute();
    $booksResult = $booksStmt->get_result();
    ?>

    <!-- Shop Section Start -->
    <section class="shop-section fix">
        <div class="container">
            <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                <h2>Books By <?php echo $author['full_name']?></h2>
            </div>
            <div class="swiper book-slider">
                <div class="swiper-wrapper">
                    <?php while($book=$booksResult->fetch_assoc()):?>
                    <div class="swiper-slide">
                        <div class="shop-box-items style-2">
                            <div class="book-thumb center">
                                <a href="bookDetails.php?isbn=<?php echo $book['isbn']?>">
                                    <img src="../../../uploads/images/<?php echo $book['image_path']?>" alt="<?php echo htmlspecialchars($book['title'])?>">
                                </a>
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
                                    <a href="wishlist.php?add=<?php echo $book['book_id']?>"><i class="far fa-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="bookDetails.php?isbn=<?php echo $book['isbn']?>"><i class="far fa-eye"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-content">
                                <h5><?php echo htmlspecialchars($book['title'])?></h5>
                                <h3><a href="bookDetails.php?isbn=<?php echo $book['isbn']?>"><?php echo htmlspecialchars($book['title'])?></a></h3>
                                <ul class="price-list">
                                    <li>$<?php echo number_format($book['price'], 2)?></li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="bookDetails.php?isbn=<?php echo $book['isbn']?>" class="theme-btn">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;?>
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
</body>
</html>