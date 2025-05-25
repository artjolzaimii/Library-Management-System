<?php 
    include("clientMenu.php");
    require_once("../../../utilities/config1.php");
    require_once("../../../src/client/guest/wishlistFunctionality.php");
    require_once("./ShoppingCart/shoppingCartFunctionalities.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eternal Library - Books Library eCommerce Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require("styleAndScripts.php"); ?>
</head>
<body>
    
    <?php include("loading.php"); include("./logInSidebar.php")?>
    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>Shop List</h1>
                <div class="page-header">
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                        <li><a href="mainPage.php">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li>Shop List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="shop-section fix section-padding pb-0">
        <div class="container">
            <div class="shop-default-wrapper">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-3 col-lg-4 order-2 order-md-1 wow fadeInUp" data-wow-delay=".3s">
                        <div class="main-sidebar">
                            <!-- Search -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title"><h5>Search</h5></div>
                                <form action="" method="POST" class="search-toggle-box">
                                    <div class="input-area search-container">
                                        <input class="search-input" type="text" placeholder="Search here" name="search">
                                        <button class="cmn-btn search-icon" type="submit">
                                            <i class="far fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- E-Book and Borrow Book Filters -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title"><h5>Book Formats</h5></div>
                                <div class="categories-list">
                                    <ul class="nav nav-pills mb-3" id="format-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if (isset($_GET['format']) && $_GET['format'] == 'ebook') echo 'active'; ?>" 
                                               href="shopList.php?format=ebook&page=1">All E-Books</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if (isset($_GET['format']) && $_GET['format'] == 'borrow') echo 'active'; ?>" 
                                               href="shopList.php?format=borrow&page=1">All Borrow Books</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Genres -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title"><h5>Categories</h5></div>
                                <div class="categories-list">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if (!isset($_GET['genre'])) echo 'active'; ?>" 
                                               href="shopList.php?page=1">All Books</a>
                                        </li>
                                        <?php 
                                            $query = "SELECT `id`, `name` FROM genres";
                                            $genreResult = mysqli_query($conn, $query);
                                            $currentGenreId = isset($_GET['genre']) ? intval($_GET['genre']) : null;
                                            while ($genre = mysqli_fetch_assoc($genreResult)) {
                                                $genreName = htmlspecialchars($genre['name']); 
                                                $genreId = $genre['id'];
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
                            <!-- Authors -->
                            <div class="single-sidebar-widget">
                                <div class="wid-title"><h5>Authors</h5></div>
                                <div class="categories-list">
                                    <ul class="nav nav-pills mb-3" id="author-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if (!isset($_GET['author'])) echo 'active'; ?>" 
                                               href="shopList.php?page=1">All Authors</a>
                                        </li>
                                        <?php 
                                            $authorQuery = "SELECT author_id, full_name FROM author";
                                            $authorResult = mysqli_query($conn, $authorQuery);
                                            $currentAuthorId = isset($_GET['author']) ? intval($_GET['author']) : null;
                                            while ($author = mysqli_fetch_assoc($authorResult)) {
                                                $authorName = htmlspecialchars($author['full_name']); 
                                                $authorId = $author['author_id'];
                                                $isActive = ($currentAuthorId == $authorId) ? 'active' : '';
                                                echo "<li class=\"nav-item\" role=\"presentation\">
                                                        <a class=\"nav-link $isActive\" 
                                                           href=\"shopList.php?author=$authorId&page=1\">
                                                           {$authorName}
                                                        </a>
                                                      </li>";  
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main Content -->
                    <div class="col-xl-9 col-lg-8 order-1 order-md-2">
                        <div class="tab-content" id="pills-tabContent">
                        <?php
                            // Determine filter
                            $formatFilter = isset($_GET['format']) ? $_GET['format'] : null;
                            $currentGenreId = isset($_GET['genre']) ? intval($_GET['genre']) : null;
                            $currentAuthorId = isset($_GET['author']) ? intval($_GET['author']) : null;
                            $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                            $perPage = 12;
                            $startPos = ($currentPage - 1) * $perPage;
                            $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : null;
                            
                            if ($formatFilter === 'ebook') {
                                
                                if ($search) {
                                    $bookQueryPerPage = "SELECT b.*, eb.book_path, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN eBook eb ON b.book_id = eb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE b.format = 'E-Book' AND b.title LIKE '%$search%'
                                        GROUP BY b.book_id
                                        LIMIT $startPos, $perPage";
                                } else {
                                    $bookQueryPerPage = "SELECT b.*, eb.book_path, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN eBook eb ON b.book_id = eb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE b.format = 'E-Book'
                                        GROUP BY b.book_id
                                        LIMIT $startPos, $perPage";
                                }
                                $pagedResult = mysqli_query($conn, $bookQueryPerPage);
                                $timer = 1;
                                echo '<div class="tab-pane fade show active" id="pills-ebook" role="tabpanel"><div class="row">';
                                while($book = mysqli_fetch_assoc($pagedResult)){
                                    echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                            <div class="shop-box-items">
                                                <div class="book-thumb center">
                                                    <a href="bookDetails.php?isbn='.$book['isbn'].'">
                                                        <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                    </a>
                                                    <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                        <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                        <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="shop-content">
                                                    <h3><a href="bookDetails.php?isbn='.$book['isbn'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                    <ul class="price-list">
                                                        <li>E-Book</li>
                                                        <li><i class="fa-solid fa-star"></i> '.($book['avg_rating']==0? 0: round($book['avg_rating'],2) )."(".$book['review_count'].")" .' </li> 
                                                    </ul>
                                                    <div class="shop-button">
                                                        <a href="'.htmlspecialchars($book['book_path']).'" class="theme-btn" target="_blank">Read/Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>';
                                    $timer++;
                                }
                                // Pagination for E-Books
                                $countQuery = "SELECT COUNT(*) as total 
                                    FROM book b
                                    JOIN eBook eb ON b.book_id = eb.book_id
                                    WHERE b.format = 'E-Book'";
                                $countResult = mysqli_query($conn, $countQuery);
                                $countRow = mysqli_fetch_assoc($countResult);
                                $ebookNrPages = ceil($countRow['total'] / $perPage);
                            
                                echo '<div class="page-nav-wrap text-center"><ul>';
                                if ($currentPage > 1) {
                                    echo "<li><a class=\"previous\" href=\"shopList.php?format=ebook&page=" . ($currentPage - 1) . "\">Previous</a></li>";
                                }
                                for ($i = 1; $i <= $ebookNrPages; $i++) {
                                    $activeClass = ($i == $currentPage) ? "active" : "";
                                    echo "<li><a class=\"page-numbers $activeClass\" href=\"shopList.php?format=ebook&page={$i}\">$i</a></li>";
                                }
                                if ($currentPage < $ebookNrPages) {
                                    echo "<li><a class=\"next\" href=\"shopList.php?format=ebook&page=" . ($currentPage + 1) . "\">Next</a></li>";
                                }
                                echo '</ul></div></div></div>';
                            }
                            else if ($formatFilter === 'borrow') {
                                
                                if ($search) {
                                    $bookQueryPerPage = "SELECT b.*, bb.inventory, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN book_author ba ON b.book_id = ba.book_id
                                        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE ba.author_id = '$currentAuthorId'
                                        AND b.format = 'For Sale'
                                        AND b.title LIKE '%$search%'
                                        GROUP BY b.book_id
                                        LIMIT $startPos, $perPage";
                                } else {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN borrow_author ba ON b.book_id = ba.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE ba.author_id = '$currentAuthorId'
                                        WHERE b.format = 'For Sale'
                                        GROUP BY b.book_id
                                        LIMIT $startPos, $perPage";
                                }
                                $pagedResult = mysqli_query($conn, $bookQueryPerPage);
                                $timer = 1;
                                echo '<div class="tab-pane fade show active" id="pills-borrow" role="tabpanel"><div class="row">';
                                while($book = mysqli_fetch_assoc($pagedResult)){
                                    echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                            <div class="shop-box-items">
                                                <div class="book-thumb center">
                                                    <a href="bookDetails.php?isbn='.$book['isbn'].'">
                                                        <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                    </a>
                                                    <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                        <li>';

                                    //add and remove from wishlist
                                                        if(isset($_SESSION['username'])) {
                                        $userId = getUserId($_SESSION['username']);
                                        if(isInWishlist($book['book_id'], $userId)) {
                                            echo '<a href="wishlist.php?remove='.$book['book_id'].'" class="btn btn-link" title="Remove from wishlist">
                                                    <i class="fas fa-heart"></i>
                                                    </a>';
                                        } else {
                                            echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                    <i class="far fa-heart"></i>
                                                    </a>';
                                        }
                                    } else {
                                        echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                              <i class="far fa-heart"></i>
                                              </a>';
                                    }
                                                        echo '</li>
                                                        <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="shop-content">
                                                    <h3><a href="bookDetails.php?isbn='.$book['isbn'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                    <ul class="price-list">
                                                        <li>For Borrow</li>
                                                        <li><i class="fa-solid fa-star"></i> '.($book['avg_rating']==0? 0: round($book['avg_rating'],2))."(".$book['review_count'].")" .' </li> 
                                                    </ul>
                                                    <div class="shop-button">
                                                        <button class="theme-btn" disabled >Free to Borrow</button>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>';
                                    $timer++;
                                }
                                // Pagination for Borrow Books
                                $countQuery = "SELECT COUNT(*) as total 
                                    FROM book b
                                    JOIN borrow_book bb ON b.book_id = bb.book_id
                                    WHERE b.format = 'For Borrow'";
                                $countResult = mysqli_query($conn, $countQuery);
                                $countRow = mysqli_fetch_assoc($countResult);
                                $borrowNrPages = ceil($countRow['total'] / $perPage);
                            
                                echo '<div class="page-nav-wrap text-center"><ul>';
                                if ($currentPage > 1) {
                                    echo "<li><a class=\"previous\" href=\"shopList.php?format=borrow&page=" . ($currentPage - 1) . "\">Previous</a></li>";
                                }
                                for ($i = 1; $i <= $borrowNrPages; $i++) {
                                    $activeClass = ($i == $currentPage) ? "active" : "";
                                    echo "<li><a class=\"page-numbers $activeClass\" href=\"shopList.php?format=borrow&page={$i}\">$i</a></li>";
                                }
                                if ($currentPage < $borrowNrPages) {
                                    echo "<li><a class=\"next\" href=\"shopList.php?format=borrow&page=" . ($currentPage + 1) . "\">Next</a></li>";
                                }
                                echo '</ul></div></div></div>';
                            }
                            else{

                            // AUTHOR FILTER
                            if ($currentAuthorId) {
                                if ($search) {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN book_author ba ON b.book_id = ba.book_id
                                        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE ba.author_id = '$currentAuthorId' 
                                        AND b.format='For Sale'
                                        AND b.title LIKE '%$search%'
                                        GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                 b.publication_year, b.publisher, b.language, b.nr_pages, sb.price
                                        LIMIT $startPos, $perPage";
                                } else {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN book_author ba ON b.book_id = ba.book_id
                                        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE ba.author_id = '$currentAuthorId' 
                                        AND b.format='For Sale'
                                        GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                 b.publication_year, b.publisher, b.language, b.nr_pages, sb.price
                                        LIMIT $startPos, $perPage";
                                }
                                $pagedResult = mysqli_query($conn, $bookQueryPerPage);
                                $timer = 1;
                                
                                // Start the output block
                                echo '<div class="tab-pane fade show active" id="pills-author" role="tabpanel"><div class="row">';
                                
                                while($book = mysqli_fetch_assoc($pagedResult)) {
                                    // Book display HTML
                                    echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                            <div class="shop-box-items">
                                                <div class="book-thumb center">
                                                    <a href="bookDetails.php?isbn='.$book['isbn'].'">
                                                        <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                    </a>
                                                    <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                        <li>';

                                    //add and remove from wishlist
                                    if(isset($_SESSION['username'])) {
                                        $userId = getUserId($_SESSION['username']);
                                        if(isInWishlist($book['book_id'], $userId)) {
                                            echo '<a href="wishlist.php?remove='.$book['book_id'].'" class="btn btn-link" title="Remove from wishlist">
                                                    <i class="fas fa-heart"></i>
                                                    </a>';
                                        } else {
                                            echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                    <i class="far fa-heart"></i>
                                                    </a>';
                                        }
                                    } else {
                                        echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                    <i class="far fa-heart"></i>
                                                    </a>';
                                    }
                                                        echo '</li>
                                                        <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="shop-content">
                                                    <h3><a href="bookDetails.php?isbn='.$book['isbn'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                    <ul class="price-list">
                                                        <li>'.number_format($book['price'], 2).' ALL</li>
                                                        <li><i class="fa-solid fa-star"></i> '.($book['avg_rating']==0? 0: round($book['avg_rating'],2) )."(".$book['review_count'].")" .' </li> 
                                                    </ul>
                                                    <div class="shop-button">
                                                        <a href="shopList.php?add='.$book['book_id'].'&author='.$currentAuthorId.'&page='.$currentPage.'" class="theme-btn">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>';
                                    $timer++;
                                }
                                echo '</div></div>';
                            }
                            // GENRE FILTER
                            else if ($currentGenreId) {
                                $genrePerPage = $perPage;
                                $genrePage = $currentPage;
                                $genreStartPos = $startPos;
                                if ($search) {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN book_genre bg ON b.book_id = bg.book_id
                                        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE bg.genre_id = '$currentGenreId' 
                                        AND b.format='For Sale' 
                                        AND b.title LIKE '%$search%'
                                        GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                 b.publication_year, b.publisher, b.language, b.nr_pages, sb.price
                                        LIMIT $genreStartPos, $genrePerPage";
                                } else {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                        FROM book b
                                        JOIN book_genre bg ON b.book_id = bg.book_id
                                        LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                        LEFT JOIN review r ON b.book_id = r.book_id
                                        WHERE bg.genre_id = '$currentGenreId' 
                                        AND b.format='For Sale'
                                        GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                 b.publication_year, b.publisher, b.language, b.nr_pages, sb.price
                                        LIMIT $genreStartPos, $genrePerPage";
                                }
                                $pagedResult = mysqli_query($conn, $bookQueryPerPage);
                                $timer = 1;
                                echo '<div class="tab-pane fade show active" id="pills-genre" role="tabpanel"><div class="row">';
                                while($book = mysqli_fetch_assoc($pagedResult)){
                                    echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                            <div class="shop-box-items">
                                                <div class="book-thumb center">
                                                    <a href="bookDetails.php?isbn='.$book['isbn'].'">
                                                        <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                    </a>
                                                    <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                        <li>';
                                                        if(isset($_SESSION['username'])) {
                                                            $userId = getUserId($_SESSION['username']);
                                                            if(isInWishlist($book['book_id'], $userId)) {
                                                                echo '<a href="wishlist.php?remove='.$book['book_id'].'" class="btn btn-link" title="Remove from wishlist">
                                                                        <i class="fas fa-heart"></i>
                                                                      </a>';
                                                            } else {
                                                                echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                                        <i class="far fa-heart"></i>
                                                                      </a>';
                                                            }
                                                        } else {
                                                            echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                                        <i class="far fa-heart"></i>
                                                                      </a>';
                                                        }
                                                        echo '</li>
                                                        <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="shop-content">
                                                    <h3><a href="bookDetails.php?isbn='.$book['isbn'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                    <ul class="price-list">
                                                        <li>'.number_format($book['price'], 2).' ALL</li>
                                                        <li><i class="fa-solid fa-star"></i> '.($book['avg_rating']==0? 0: round($book['avg_rating'],2) )."(".$book['review_count'].")" .' </li> 
                                                    </ul>
                                                    <div class="shop-button">
                                                        <a href="shopList.php?add='.$book['book_id'].'&genre='.$currentGenreId.'&page='.$genrePage.'" class="theme-btn">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>';
                                    $timer++;
                                }
                                // Pagination for genres
                                $countQuery = "SELECT COUNT(*) as total 
                                    FROM book b
                                    JOIN book_genre bg ON b.book_id = bg.book_id
                                    WHERE bg.genre_id = $currentGenreId AND b.format='For Sale'";
                                $countResult = mysqli_query($conn, $countQuery);
                                $countRow = mysqli_fetch_assoc($countResult);
                                $genreNrPages = ceil($countRow['total'] / $genrePerPage);

                                echo '<div class="page-nav-wrap text-center"><ul>';
                                if ($genrePage > 1) {
                                    echo "<li><a class=\"previous\" href=\"shopList.php?genre={$currentGenreId}&page=" . ($genrePage - 1) . "\">Previous</a></li>";
                                }
                                for ($i = 1; $i <= $genreNrPages; $i++) {
                                    $activeClass = ($i == $genrePage) ? "active" : "";
                                    echo "<li><a class=\"page-numbers $activeClass\" href=\"shopList.php?genre={$currentGenreId}&page={$i}\">$i</a></li>";
                                }
                                if ($genrePage < $genreNrPages) {
                                    echo "<li><a class=\"next\" href=\"shopList.php?genre={$currentGenreId}&page=" . ($genrePage + 1) . "\">Next</a></li>";
                                }
                                echo '</ul></div></div></div>';
                            }
                            // ALL BOOKS
                            else {
                                if ($search) {
                                    $bookQuery = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                            FROM book b
                                            JOIN book_author ba ON b.book_id = ba.book_id
                                            LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                            LEFT JOIN review r ON b.book_id = r.book_id
                                            WHERE b.format='For Sale' AND b.title LIKE '%$search%'
                                            GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                     b.publication_year, b.publisher, b.language, b.nr_pages, sb.price";
                                } else {
                                    $bookQuery = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                            FROM book b
                                            JOIN book_author ba ON b.book_id = ba.book_id
                                            LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                            LEFT JOIN review r ON b.book_id = r.book_id
                                            WHERE b.format='For Sale'
                                            GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                     b.publication_year, b.publisher, b.language, b.nr_pages, sb.price";
                                }
                                $bookResult = mysqli_query($conn, $bookQuery);  
                                $nrBooks = $bookResult->num_rows;
                                $perPage = 12;
                                $nrPages = ceil($nrBooks/$perPage);
                                $page = $currentPage;
                                $startPos = ($page-1)*$perPage;
                                if ($search) {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                            FROM book b, AVG(r.rating) AS avg_rating
                                            JOIN book_genre bg ON b.book_id = bg.book_id
                                            LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                            LEFT JOIN review r ON b.book_id = r.book_id
                                            WHERE b.format='For Sale' AND b.title LIKE '%$search%'
                                            GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                     b.publication_year, b.publisher, b.language, b.nr_pages, sb.price
                                            LIMIT $startPos, $perPage";
                                } else {
                                    $bookQueryPerPage = "SELECT b.*, sb.price, AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
                                            FROM book b
                                            JOIN book_author ba ON b.book_id = ba.book_id
                                            LEFT JOIN sale_book sb ON b.book_id = sb.book_id
                                            LEFT JOIN review r ON b.book_id = r.book_id
                                            WHERE b.format='For Sale'
                                            GROUP BY b.book_id, b.title, b.isbn, b.image_path, b.format, b.description, 
                                                     b.publication_year, b.publisher, b.language, b.nr_pages, sb.price
                                            LIMIT $startPos, $perPage";
                                }
                                $perPageResult = mysqli_query($conn, $bookQueryPerPage);
                                $timer = 1;
                                echo '<div class="tab-pane fade show active" id="pills-all" role="tabpanel"><div class="row">';
                                while($book = mysqli_fetch_assoc($perPageResult)){
                                    echo '<div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".'.$timer.'s">
                                            <div class="shop-box-items">
                                                <div class="book-thumb center">
                                                    <a href="bookDetails.php?isbn='.$book['isbn'].'">
                                                        <img src="'.htmlspecialchars("../../../uploads/images/".$book['image_path']).'" alt="img" style="height:213px; width:148px;">
                                                    </a>
                                                    <ul class="shop-icon d-grid justify-content-center align-items-center">
                                                        <li>';
                                                        if(isset($_SESSION['username'])) {
                                                            $userId = getUserId($_SESSION['username']);
                                                            if(isInWishlist($book['book_id'], $userId)) {
                                                                echo '<a href="wishlist.php?remove='.$book['book_id'].'" class="btn btn-link" title="Remove from wishlist">
                                                                        <i class="fas fa-heart"></i>
                                                                      </a>';
                                                            } else {
                                                                echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                                        <i class="far fa-heart"></i>
                                                                      </a>';
                                                            }
                                                        } else {
                                                            echo '<a href="wishlist.php?add='.$book['book_id'].'" class="btn btn-link" title="Add to wishlist">
                                                                  <i class="far fa-heart"></i>
                                                                  </a>';
                                                        }
                                                        echo '</li>
                                                        <li><a href="bookDetails.php?isbn='.$book['isbn'].'"><i class="far fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="shop-content">
                                                    <h3><a href="bookDetails.php?isbn='.$book['isbn'].'">'.htmlspecialchars($book['title']).'</a></h3>
                                                    <ul class="price-list">
                                                        <li>'.number_format($book['price'], 2).' ALL</li>
                                                        <li><i class="fa-solid fa-star"></i> '.($book['avg_rating']==0? 0: round($book['avg_rating'],2) )."(".$book['review_count'].")" .' </li> 
                                                    </ul>
                                                    <div class="shop-button">
                                                        <a href="shopList.php?add='.$book['book_id'].'&page='.$page.'" class="theme-btn">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    $timer++;
                                }
                                echo '<div class="page-nav-wrap text-center"><ul>';
                                if ($page > 1) {  
                                    echo '<li><a class="previous" href="shopList.php?page='.($page - 1) .'">Previous</a></li>';  
                                }  
                                for ($i = 1; $i <= $nrPages; $i++) {  
                                    $activeClass = ($i == $page) ? 'active' : '';
                                    echo '<li><a class="page-numbers '.$activeClass.'" href="shopList.php?page='.$i.'">'.$i.'</a></li>';  
                                }  
                                if ($page < $nrPages) {  
                                    echo '<li><a class="next" href="shopList.php?page='.($page + 1) .'">Next</a></li>';  
                                }  
                                echo '</ul></div></div></div>';
                            }
                            
                            }
                        ?>
                        <!-- Handling book add-->
                        <?php  
                            if(isset($_GET['add'])){
                                addBookToBasket($conn,$_GET['add'],1);
                                echo '<script>window.location.href = "shopList.php?page='.$_GET['page'].'";</script>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
</body>
</html>