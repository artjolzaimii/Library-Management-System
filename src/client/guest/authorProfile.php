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

    <?php 
        // Calculate sales
        $salesQuery = "SELECT SUM(ob.quantity) AS nr_sales
                       FROM book_author ba
                       INNER JOIN book b ON ba.book_id = b.book_id
                       INNER JOIN order_book ob ON ob.book_id = ba.book_id
                       WHERE ba.author_id = ?";
        $stm1 = $conn->prepare($salesQuery);
        $stm1->bind_param("i", $authorId);
        $stm1->execute();
        $res1 = $stm1->get_result();
        $book1 = $res1->fetch_assoc();
        $salesCount = $book1 ? $book1['nr_sales'] : 0;
    
        // Calculate reviews
        $reviewQuery = "SELECT COUNT(*) as nr_reviews
                        FROM book_author ba
                        INNER JOIN book b ON ba.book_id = b.book_id
                        INNER JOIN review r ON r.book_id = b.book_id
                        WHERE ba.author_id = ?";
        $stm2 = $conn->prepare($reviewQuery);
        $stm2->bind_param("i", $authorId);
        $stm2->execute();
        $res2 = $stm2->get_result();
        $book2 = $res2->fetch_assoc();
        $reviewCount = $book2 ? $book2['nr_reviews'] : 0;
    ?>

    
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
                        <span><?php echo $author['nationality']?></span><br>
                        <span><?php echo $author['birth_year'].' - '.($author['death_year']!=0? $author['death_year']: "")?></span>
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
                        <h2><span class="count"><?php echo $salesCount ?></span>+</h2>
                        <p>Sales</p>
                    </div>
                    <div class="counter-items wow fadeInUp" data-wow-delay=".7s">
                        <h2><span class="count"><?php echo $reviewCount; ?></span>+</h2>
                        <p>Review</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Author's books -->
    <?php 
        //handle add to cart
        require_once("./ShoppingCart/shoppingCartFunctionalities.php");
        if(isset($_GET['add'])){
            addBookToBasket($conn,$_GET['add'],1);
            
        }
        
        $forSale="SELECT b.book_id,isbn, title, image_path , price,AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                FROM book b INNER JOIN book_author ba ON b.book_id=ba.book_id
                INNER JOIN sale_book sa ON sa.book_id=b.book_id
                LEFT JOIN review r ON b.book_id = r.book_id
                WHERE ba.author_id=?
                GROUP BY b.book_id";
                
        $stm=$conn->prepare($forSale);
        $stm->bind_param("i",$authorId);
        $stm->execute();
        $forSaleResult=$stm->get_result();
        
        $forBorrow="SELECT b.book_id,isbn, title, image_path,AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count 
                FROM book b INNER JOIN book_author ba ON b.book_id=ba.book_id
                INNER JOIN borrow_book boa ON boa.book_id=b.book_id
                LEFT JOIN review r ON b.book_id = r.book_id
                WHERE ba.author_id=?
                GROUP BY b.book_id"
                ;
        $stm=$conn->prepare($forBorrow);
        $stm->bind_param("i",$authorId);
        $stm->execute();
        $forBorrowResult=$stm->get_result();        
                
        $eBook="SELECT b.book_id,isbn, title, image_path,AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                FROM book b INNER JOIN book_author ba ON b.book_id=ba.book_id
                INNER JOIN ebook e ON e.book_id=b.book_id
                LEFT JOIN review r ON b.book_id = r.book_id
                WHERE ba.author_id=?
                GROUP BY b.book_id";
        $stm=$conn->prepare($eBook);
        $stm->bind_param("i",$authorId);
        $stm->execute();
        $eBookResult=$stm->get_result();        
    ?>
    <!-- Shop Section Start -->
    <section class="shop-section fix">
        <div class="container">
            <div class="section-title wow fadeInUp" data-wow-delay=".3s">
                <h2>Books By <?php echo $author['full_name']?></h2>
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
                                    <a href="wishlist.php?add=<?php echo $book['book_id']?>"><i class="far fa-heart"></i></a>
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
                                <h3><a href="bookDetails.php?isbn=<?php echo $book['isbn']?>"><?php echo $book['title']?></a></h3>
                                <ul class="price-list">
                                    <li>$<?php echo number_format($book['price'], 2)?></li>
                                    <li><?php echo $book['price']?></li>
                                
                                </ul>
                                <ul class="author-post">
                                    <li class="authot-list">
                                        <span class="thumb">
                                            <img src="../../../<?php echo $author['image_path']?>" alt="img" width="30px" height="30px">
                                        </span>
                                        <span class="content"><?php echo $author['full_name'];?></span>
                                    </li>

                                    <li class="">
                                        <div class="star">
                                            <?php
                                            $rating = round($book['avg_rating']);
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<i class="fa-' . ($i <= $rating ? 'solid' : 'regular') . ' fa-star"></i>';
                                            }
                                            ?>
                                            (<?= $book['review_count'] ?>)
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-button">
                                <a href="authorProfile.php?authorId=<?php echo $authorId?>&add=<?php echo $book['book_id']?>" class="theme-btn">Add To Cart</a>
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
    <?php include("footer.php")?>
</body>
</html>