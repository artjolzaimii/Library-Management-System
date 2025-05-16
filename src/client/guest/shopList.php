<!-- Header Section Start -->
<?php 
    include("clientMenu.php");
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
    <title>Eternal Library - Books Library eCommerce Store</title>
    
    <?php 
        require("styleAndScripts.php");
    ?>
</head>

<body>
    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    
<!-- Preloader start -->
     <?php 
        include("loading.php");
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
                                    <a target="_blank" href="shop.html">Main Street, Melbourne, Australia</a>
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
                                    <a target="_blank" href="shop.html">Mod-friday, 09am -05pm</a>
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
        include("logInSidebar.php");
    ?>

    <!-- Breadcumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>Shop List</h1>
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
                            Shop Default
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Section Start -->
    <section class="shop-section fix section-padding pb-0">
        <div class="container">
            <div class="shop-default-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="woocommerce-notices-wrapper wow fadeInUp" data-wow-delay=".3s">
                            <p>Showing 1-3 Of 34 books </p>
                            <div class="form-clt">
                                <div class="nice-select" tabindex="0">
                                    <span class="current">
                                        Default Sorting
                                    </span>
                                    <ul class="list">
                                        <li data-value="1" class="option selected focus">
                                            Default sorting
                                        </li>
                                        <li data-value="1" class="option">
                                            Sort by popularity
                                        </li>
                                        <li data-value="1" class="option">
                                            Sort by average rating
                                        </li>
                                        <li data-value="1" class="option">
                                            Sort by latest
                                        </li>
                                    </ul>
                                </div>
                                <div class="icon">
                                    <a href="shop-list.html"><i class="fas fa-list"></i></a>
                                </div>
                                <div class="icon-2 active">
                                    <a href="shop.html"><i class="fa-sharp fa-regular fa-grid-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 order-2 order-md-1 wow fadeInUp" data-wow-delay=".3s">
                        <div class="main-sidebar">
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h5>Search</h5>
                                </div>
                                <form action="" method="POST" class="search-toggle-box">
                                    <div class="input-area search-container">
                                        <input class="search-input" type="text" placeholder="Search here" name="search">
                                        <button class="cmn-btn search-icon" type="submit">
                                            <i class="far fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h5>Categories</h5>
                                </div>
                                <div class="categories-list">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <!-- All Books -->
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if (!isset($_GET['genre'])) echo 'active'; ?>" 
                                               href="shopList.php?page=1">All Books</a>
                                        </li>
                                        <!--All Genres -->
                                        <?php 
                                            $query = "SELECT `id`, `name` FROM genres";
                                            $genreResult = mysqli_query($conn, $query);
                                            $currentGenreId = isset($_GET['genre']) ? intval($_GET['genre']) : null;
                                        
                                            while ($genre = mysqli_fetch_assoc($genreResult)) {
                                                $genreName = htmlspecialchars($genre['name']); 
                                                $genreId = $genre['id'];
                                                $urlId = strtolower(str_replace(' ', '-', $genreName));
                                                
                                                $isActive = ($currentGenreId == $genreId) ? 'active' : '';
                                        
                                                echo "<li class=\"nav-item\" role=\"presentation\">
                                                        <a class=\"nav-link $isActive\" 
                                                           href=\"shopList.php?genre=$genreId&page=1\">
                                                           {$genreName}
                                                        </a>
                                                      </li>";  
                                            }
                                        ?>

                                        
                                    </ul>
                                </div>
                            </div>
                                        <!-- Possible removal -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title">
                                    <h5>Product Status</h5>
                                </div>
                                <div class="product-status">
                                    <div class="product-status_stock  gap-6 d-flex align-items-center">
                                        <div class="nice-select category" tabindex="0"><span class="current">
                                                In Stock
                                            </span>
                                            <ul class="list">
                                                <li data-value="1" class="option selected">
                                                    In Stock
                                                </li>
                                                <li data-value="1" class="option">
                                                    Castle In The Sky
                                                </li>
                                                <li data-value="1" class="option">
                                                    The Hidden Mystery Behind
                                                </li>
                                                <li data-value="1" class="option">
                                                    Flovely And Unicom Erna
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-status_sale gap-6 d-flex align-items-center">
                                        <div class="nice-select category" tabindex="0">
                                            <span class="current">
                                                On Sale
                                            </span>
                                            <ul class="list">
                                                <li data-value="1" class="option selected">
                                                    On Sale
                                                </li>
                                                <li data-value="1" class="option">
                                                    Flovely And Unicom Erna
                                                </li>
                                                <li data-value="1" class="option">
                                                    Castle In The Sky
                                                </li>
                                                <li data-value="1" class="option">
                                                    How Deal With Very Bad BOOK
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="single-sidebar-widget mb-50">
                                <div class="wid-title">
                                    <h5>Filter By Price</h5>
                                </div>
                                <div class="range__barcustom">
                                    <div class="slider">
                                        <div class="progress" style="left: 15.29%; right: 58.9%;"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="10000" value="2500">
                                        <input type="range" class="range-max" min="100" max="10000" value="7500">
                                    </div>
                                    <div class="range-items">
                                        <div class="price-input">
                                            <div class="d-flex align-items-center">
                                                <a href="shop-left-sidebar.html" class="filter-btn mt-2 me-3">Filter</a>
                                                <div class="field">
                                                    <span>Price:</span>
                                                </div>
                                                <div class="field">
                                                    <span>$</span>
                                                    <input type="number" class="input-min" value="100">
                                                </div>
                                                <div class="separators">-</div>
                                                <div class="field">
                                                    <span>$</span>
                                                    <input type="number" class="input-max" value="1000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-sidebar-widget mb-0">
                                <div class="wid-title">
                                    <h5>By Review</h5>
                                </div>
                                <div class="categories-list">
                                    <label class="checkbox-single d-flex align-items-center">
                                        <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                            <span class="checkbox-area d-center">
                                                <input type="checkbox">
                                                <span class="checkmark d-center"></span>
                                            </span>
                                            <span class="text-color">
                                                <span class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </span>
                                                35
                                            </span>
                                        </span>
                                    </label>
                                    <label class="checkbox-single d-flex align-items-center">
                                        <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                            <span class="checkbox-area d-center">
                                                <input type="checkbox">
                                                <span class="checkmark d-center"></span>
                                            </span>
                                            <span class="text-color">
                                                <span class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                </span>
                                                24
                                            </span>
                                        </span>
                                    </label>
                                    <label class="checkbox-single d-flex align-items-center">
                                        <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                            <span class="checkbox-area d-center">
                                                <input type="checkbox">
                                                <span class="checkmark d-center"></span>
                                            </span>
                                            <span class="text-color">
                                                <span class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                </span>
                                                15
                                            </span>
                                        </span>
                                    </label>
                                    <label class="checkbox-single d-flex align-items-center">
                                        <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                            <span class="checkbox-area d-center">
                                                <input type="checkbox">
                                                <span class="checkmark d-center"></span>
                                            </span>
                                            <span class="text-color">
                                                <span class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                </span>
                                                2
                                            </span>
                                        </span>
                                    </label>
                                    <label class="checkbox-single d-flex align-items-center">
                                        <span class="d-flex gap-xl-3 gap-2 align-items-center">
                                            <span class="checkbox-area d-center">
                                                <input type="checkbox">
                                                <span class="checkmark d-center"></span>
                                            </span>
                                            <span class="text-color">
                                                <span class="star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                    <i class="fa-sharp fa-light fa-star"></i>
                                                </span>
                                                1
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 order-1 order-md-2">
                        <div class="tab-content" id="pills-tabContent">
                        <?php
                            $currentGenreId = isset($_GET['genre']) ? intval($_GET['genre']) : null;
                            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
                        ?>

                        <?php 
                            global $nrPages;
                            global $page;
                            
                            // ----- ALL BOOKS TAB -----
                            $isAllActive = (!isset($_GET['genre'])) ? 'show active' : '';
                            echo '<div class="tab-pane fade '.$isAllActive.'" id="pills-all" role="tabpanel"
                                    aria-labelledby="pills-all-tab" tabindex="0">
                                    <div class="row">';
                                    
                            if(isset($_POST['search'])){
                                $search=mysqli_real_escape_string($conn, $_POST['search']);
                                $bookQuery = "SELECT b.*, sb.price 
                                          FROM book b
                                          JOIN book_genre bg ON b.book_id = bg.book_id
                                          LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                          WHERE b.format='For Sale' AND b.title LIKE '%$search%'
                                          GROUP BY b.book_id";
                            }
                            else{
                                 $bookQuery = "SELECT b.*, sb.price 
                                          FROM book b
                                          JOIN book_genre bg ON b.book_id = bg.book_id
                                          LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                          WHERE b.format='For Sale'
                                          GROUP BY b.book_id";
                            }        
                                    
                            $bookResult = mysqli_query($conn, $bookQuery);  
                            
                            $nrBooks=$bookResult->num_rows;
                            $perPage=1;
                            $nrPages=ceil($nrBooks/$perPage);
                                    
                            if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nrPages){
                                $page=mysqli_real_escape_string($conn,$_GET['page']);
                                $startPos=($page-1)*$perPage;
                                $endPos=$startPos+$perPage;
                                    
                            }   
                            else{ 
                                $page=1;
                                $startPos=0;
                                $endPos=$perPage;
                            }
                            if(isset($_POST['search'])){
                                $search=mysqli_real_escape_string($conn, $_POST['search']);
                                $bookQueryPerPage = "SELECT b.*, sb.price 
                                          FROM book b
                                          JOIN book_genre bg ON b.book_id = bg.book_id
                                          LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                          WHERE b.format='For Sale' AND b.title LIKE '%$search%'
                                          GROUP BY b.book_id
                                          LIMIT $startPos, $perPage";
                            }
                            else{
                                 $bookQueryPerPage = "SELECT b.*, sb.price 
                                          FROM book b
                                          JOIN book_genre bg ON b.book_id = bg.book_id
                                          LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                          WHERE b.format='For Sale'
                                          GROUP BY b.book_id
                                          LIMIT $startPos, $perPage";
                            }
                           
                            $perPageResult=mysqli_query($conn,$bookQueryPerPage);
                            $timer = 1;
                        
                            while($book = mysqli_fetch_assoc($perPageResult)){
                                echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                        <div class="shop-box-items">
                                            <div class="book-thumb center">
                                                <a href="shop-details.php?id='.$book['book_id'].'">
                                                    <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                </a>
                                                <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="shop-content">
                                                <h3><a href="shop-details.php?id='.$book['book_id'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                <ul class="price-list">
                                                    <li>'.number_format($book['price'], 2).' ALL</li>
                                                    <li><i class="fa-solid fa-star"></i> 3.4 (25)</li> 
                                                </ul>
                                                <div class="shop-button">
                                                    <a href="shop-cart.php?add='.$book['book_id'].'" class="theme-btn">Add To Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                      </div>';
                                $timer++;
                            }
                            ?>
                            <div class="page-nav-wrap text-center">
                                <ul>
                                    <?php  
                                    if ($page > 1) {  
                                        echo "<li><a class=\"previous\" href=\"shopList.php?page=" . ($page - 1) . "\">Previous</a></li>";  
                                    }  
                            
                                    for ($i = 1; $i <= $nrPages; $i++) {  
                                        $activeClass = ($i == $page) ? "active" : "";
                                        echo "<li><a class=\"page-numbers $activeClass\" href=\"shopList.php?page={$i}\">$i</a></li>";  
                                    }  
                            
                                    if ($page < $nrPages) {  
                                        echo "<li><a class=\"next\" href=\"shopList.php?page=" . ($page + 1) . "\">Next</a></li>";  
                                    }  
                                    ?>
                                </ul>
                        </div>
                        <?php
                            echo '</div></div>'; 
                        ?>
                        <?php
                            // ----- GENRE-SPECIFIC TABS -----
                            $query = "SELECT `id`, `name` FROM genres";
                            $genreResult = mysqli_query($conn, $query);
                            while($genre = mysqli_fetch_assoc($genreResult)){
                                $genreName = htmlspecialchars($genre['name']);
                                $genreId = strtolower(str_replace(' ', '-', $genreName));
                                $genreDbId = $genre['id'];
                                $isActive = ($currentGenreId == $genreDbId) ? 'show active' : '';
                                echo '<div class="tab-pane fade '.$isActive.'" id="pills-'.$genreId.'" role="tabpanel"
                                      aria-labelledby="pills-'.$genreId.'-tab" tabindex="0">
                                      <div class="row">';

                                if ($currentGenreId == $genreDbId) {
                                    $genrePerPage = 1;
                                    $genrePage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                                    $genreStartPos = ($genrePage - 1) * $genrePerPage;

                                    if (isset($_POST['search'])) {
                                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                                        $bookQueryPerPage = "SELECT b.*, sb.price 
                                            FROM book b
                                            JOIN book_genre bg ON b.book_id = bg.book_id
                                            LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                            WHERE bg.genre_id = '$genreDbId' 
                                            AND b.format='For Sale' 
                                            AND b.title LIKE '%$search%'
                                            LIMIT $genreStartPos, $genrePerPage";
                                    } else {
                                        $bookQueryPerPage = "SELECT b.*, sb.price 
                                            FROM book b
                                            JOIN book_genre bg ON b.book_id = bg.book_id
                                            LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                            WHERE bg.genre_id = '$genreDbId' 
                                            AND b.format='For Sale'
                                            LIMIT $genreStartPos, $genrePerPage";
                                    }

                                    $pagedResult = mysqli_query($conn, $bookQueryPerPage);
                                    $timer = 1;
                                    while($book = mysqli_fetch_assoc($pagedResult)){
                                        echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                                <div class="shop-box-items">
                                                    <div class="book-thumb center">
                                                        <a href="shop-details.php?id='.$book['book_id'].'">
                                                            <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                        </a>
                                                        <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                            <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="shop-content">
                                                        <h3><a href="shop-details.php?id='.$book['book_id'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                        <ul class="price-list">
                                                            <li>'.number_format($book['price'], 2).' ALL</li>
                                                            <li><i class="fa-solid fa-star"></i> 3.4 (25)</li> 
                                                        </ul>
                                                        <div class="shop-button">
                                                            <a href="shop-cart.php?add='.$book['book_id'].'" class="theme-btn">Add To Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>';
                                        $timer++;
                                    }

                                    // Pagination
                                    $countQuery = "SELECT COUNT(*) as total 
                                        FROM book b
                                        JOIN book_genre bg ON b.book_id = bg.book_id
                                        WHERE bg.genre_id = $genreDbId AND b.format='For Sale'";
                                    $countResult = mysqli_query($conn, $countQuery);
                                    $countRow = mysqli_fetch_assoc($countResult);
                                    $genreNrPages = ceil($countRow['total'] / $genrePerPage);

                                    echo '<div class="page-nav-wrap text-center"><ul>';
                                    if ($genrePage > 1) {
                                        echo "<li><a class=\"previous\" href=\"shopList.php?genre={$genreDbId}&page=" . ($genrePage - 1) . "\">Previous</a></li>";
                                    }

                                    for ($i = 1; $i <= $genreNrPages; $i++) {
                                        $activeClass = ($i == $genrePage) ? "active" : "";
                                        echo "<li><a class=\"page-numbers $activeClass\" href=\"shopList.php?genre={$genreDbId}&page={$i}\">$i</a></li>";
                                    }

                                    if ($genrePage < $genreNrPages) {
                                        echo "<li><a class=\"next\" href=\"shopList.php?genre={$genreDbId}&page=" . ($genrePage + 1) . "\">Next</a></li>";
                                    }

                                    echo '</ul></div>'; // close pagination
                                }

                                echo '</div></div>'; 
                            }

                        ?>

                        </div>
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
                                    <img src="../assets/img/logo/logo.svg" alt="logo-img">
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
                            <img src="../assets/img/footer/01.png" alt="img">
                        </div>
                        <div class="app-image">
                            <img src="../assets/img/footer/02.png" alt="img">
                        </div>
                        <div class="app-image">
                            <img src="../assets/img/footer/03.png" alt="img">
                        </div>
                        <div class="app-image">
                            <img src="../assets/img/footer/04.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>