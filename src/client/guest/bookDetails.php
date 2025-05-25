<!-- Header Section Start -->
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
    <meta name="description" content="Boimela - Books Library eCommerce Store">
    <!-- ======== Page title ============ -->
    <title>Eternal Library - Books Library eCommerce Store</title>
    <!--<< Favcion >>-->
    <link rel="shortcut icon" href="../../assets/img/favicon.png">
    <!--<< Bootstrap min.css >>-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!--<< All Min Css >>-->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <!--<< Animate.css >>-->
    <link rel="stylesheet" href="../assets/css/animate.css">
    <!--<< Magnific Popup.css >>-->
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <!--<< MeanMenu.css >>-->
    <link rel="stylesheet" href="../assets/css/meanmenu.css">
    <!--<< Swiper Bundle.css >>-->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">
    <!--<< Nice Select.css >>-->
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <!--<< Icomoon.css >>-->
    <link rel="stylesheet" href="../assets/css/icomoon.css">
    <!--<< Main.css >>-->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
<!-- Find book by isbn , placed in the url by a get request-->
   <?php
        
        $isbn = mysqli_real_escape_string($conn, $_GET['isbn']);
        
        // Main book data query
        $query = "SELECT b.book_id, `isbn`, `publication_year`, `publisher`, `language`, `nr_pages`, `description`, `format`, `image_path`, `title` ,AVG(r.rating) AS avg_rating, COUNT(r.review_id) AS review_count
        FROM book b LEFT JOIN review r ON b.book_id = r.book_id
        WHERE `isbn`=?
        GROUP BY b.book_id"
        ;
        $stm = $conn->prepare($query);
        $stm->bind_param("s", $isbn);
        $stm->execute();
        $result = $stm->get_result();
        
        if ($result->num_rows !== 1) {
            echo "The book with this ISBN does not exist!";
            exit; // Stop execution
        }
        
        $row = $result->fetch_assoc();
        
        // Load format-specific info
        switch ($row['format']) {
            case 'For Sale':
                $query = "SELECT inventory, price FROM sale_book WHERE book_id=?";
                break;
        
            case 'For Borrow':
                $query = "SELECT inventory, `book_condition` FROM borrow_book WHERE book_id=?";
                break;
        
            case 'E-Book':
                $query = "SELECT book_path FROM ebook WHERE book_id=?";
                break;
        
            default:
                echo "Invalid book format!";
                exit;
        }
        
        $stm = $conn->prepare($query);
        $stm->bind_param("i", $row['book_id']);
        $stm->execute();
        $result = $stm->get_result();
        
        if ($result->num_rows !== 1) {
            echo "Details for the selected format were not found!";
            exit;
        }
        
        $formatRow = $result->fetch_assoc(); // Holds saleRow / borrowRow / ebookRow
        
        // Fetch authors
        $query = "SELECT full_Name FROM author 
            INNER JOIN book_author ON author.author_id = book_author.author_id 
            WHERE book_author.book_id = ?";
        $stm = $conn->prepare($query);
        $stm->bind_param("i", $row['book_id']);
        $stm->execute();
        $authorResult = $stm->get_result();
        
        $authors = [];
        while ($author = $authorResult->fetch_assoc()) {
            $authors[] = $author['full_Name'];
        }
        $authors = implode(", ", $authors);
        
        // Fetch genres
        $query = "SELECT `name` FROM genres 
            INNER JOIN book_genre ON genres.id = book_genre.genre_id 
            WHERE book_genre.book_id = ?";
        $stm = $conn->prepare($query);
        $stm->bind_param("i", $row['book_id']);
        $stm->execute();
        $genreResult = $stm->get_result();
        
        $genres = [];
        while ($genre = $genreResult->fetch_assoc()) {
            $genres[] = $genre['name'];
        }
        $genres = implode(", ", $genres);
        
        ?>

    
        

    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    <!-- Preloader Start -->
     <?php 
        require("loading.php");
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
                                <img src="../assets/img/logo/logo.png" alt="logo-img">
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
                                    <a target="_blank" href="shop-details.html">Mod-friday, 09am -05pm</a>
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
                                        <img src="<?php echo '../../../uploads/images/'.$row['image_path'] ?>" alt="img" height="402px" width="315px" >
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="shop-details-content">
                            <div class="title-wrapper">
                                <h2><?php echo $row['title'];  ?></h2>
                                <h5>
                                    <?php 
                                        if($row['format']=='For Sale'){
                                            if($formatRow['inventory']>0){
                                                echo "<h5>Stock Available</h5>";
                                            }
                                            else{
                                                echo "<h5 style=\"color: red;\">Out of Stock</h5>";
                                            }
                                        }
                                        else if($row['format']=='For Borrow'){
                                            if($formatRow['inventory']>0){
                                                echo "<h5>Stock Available</h5>";
                                            }
                                            else{
                                                echo "<h5 style=\"color: red;\">Out of Stock</h5>";
                                            }
                                        }
                                    ?>
                                </h5>
                            </div>
                            <div class="star">
                                    <?php
                                    $rating = round($row['avg_rating']);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<i class="fa-' . ($i <= $rating ? 'solid' : 'regular') . ' fa-star"></i>';
                                    }
                                    ?>
                                    (<?= $row['review_count']. " Customer Reviews" ?>)
                                </div>
                            <p>
                                <?php 
                                    echo $row['description'];
                                ?>
                            </p>
                            <?php 
                                if($row['format']=='For Sale'){
                                    echo "<div class=\"price-list\">
                                            <h3>".$formatRow['price']." ALL</h3>
                                        </div>";
                                }
                            
                            ?>
                            <!--If an item is out of stock make buttons, inputs disabled -->
                            <form action="" method="POST" >
                                <div class="cart-wrapper">
                                <div class="quantity-basket"  <?php if($row['format']=='E-Book' || $row['format']=='For Borrow'){
                                                    echo "style=\"display: none;\"";
                                                }
                                            ?>>
                                    <p class="qty">
                                        <button class="qtyminus" aria-hidden="true"
                                            <?php 
                                                if($row['format']=='For Sale'){
                                                    if($formatRow['inventory']<0){
                                                        echo "disabled;";
                                                    }       
                                                }
                                            ?>
                                         ></button>
                                          <input type="number" name="quantity" id="qty2" min="1" max="199" step="1" value="1"
                                            <?php 
                                                if($row['format']=='For Sale' ){
                                                    if($formatRow['inventory']<0){
                                                        echo "disabled;";
                                                    }       
                                                }
                                                
                                            ?>>
                                        
                                        <button class="qtyplus" aria-hidden="true"
                                            <?php 
                                                if($row['format']=='For Sale'){
                                                    if($formatRow['inventory']<0){
                                                        echo "disabled;";
                                                    }       
                                                }
                                            ?>
                                        ></button>
                                    </p>
                                </div>
                              

                                                                                                
                                                                    <!-- Read/Download Button -->
                                    <button type="button"
                                            class="theme-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#readBookModal<?= $row['book_id'] ?>">
                                    <i class="bx bx-book-open"></i> Read/Download
                                    </button>

                                    <!-- Modal for Read/Download Preview -->
                                    <div class="modal fade" id="readBookModal<?= $row['book_id'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Preview & Download: <?= htmlspecialchars($row['title']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <?php
                                            $book_id = $row['book_id'];
                                            $previewDir = "../../../uploads/previews/$book_id.pdf";
                                            $ebookPath = "../../../uploads/eBooks/$book_id.pdf";

                                            // Show previews (PDF or images)
                                            if (is_dir($previewDir)) {
                                            $files = glob($previewDir . "*.{jpg,jpeg,png,pdf}", GLOB_BRACE);
                                            if ($files && count($files) > 0) {
                                                echo "<div class='row'>";
                                                foreach ($files as $file) {
                                                $fileUrl = htmlspecialchars($file);
                                                if (preg_match('/\.(jpg|jpeg|png)$/i', $file)) {
                                                    echo "<div class='col-md-3 mb-3'><img src='$fileUrl' class='img-fluid rounded' style='border:1px solid #ccc;'></div>";
                                                } elseif (preg_match('/\.pdf$/i', $file)) {
                                                    echo "<div class='col-12 mb-3'><embed src='$fileUrl' type='application/pdf' width='100%' height='500px'></div>";
                                                }
                                                }
                                                echo "</div>";
                                            } else {
                                                echo "<p class='text-muted'>No preview available for this book.</p>";
                                            }
                                            } else {
                                            echo "<p class='text-muted'>No preview available for this book.</p>";
                                            }
                                            ?>
                                        </div>

                                        <div class="modal-footer">
                                            <?php
                                            if (file_exists($ebookPath)) {
                                            $ebookUrl = htmlspecialchars($ebookPath);
                                            echo "<a href='$ebookUrl' download class='btn btn-primary' target='_blank'><i class='bx bx-download'></i> Download Full Book (PDF)</a>";
                                            } else {
                                            echo "<button class='btn btn-secondary' disabled>No PDF Available</button>";
                                            }
                                            ?>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>




                                <!-- Submit button of form-->
                                <button  type="submit" class="theme-btn"  <?php if($row['format']=='E-Book' || $row['format']=='For Borrow'){
                                                    echo "style=\"display: none;\"";
                                                }
                                            ?>>Add To Cart</button>
                                <div class="icon-box">
                                    <?php if(isset($_SESSION['username'])){
                                        $userId = getUserId($_SESSION['username']);
                                        if(isInWishlist($row['book_id'], $userId)){
                                            echo "<a href='wishlist.php?remove=" . $row['book_id'] . "' class='icon'>
                                                    <i class='far fa-heart'></i>
                                                </a>";
                                        } else {
                                            echo "<a href='wishlist.php?add=" . $row['book_id'] . "' class='icon'>
                                                    <i class='far fa-heart'></i>
                                                </a>";
                                        }
                                    } else {
                                        echo "<a href='wishlist.php?add=" . $row['book_id'] . "' class='icon'>
                                                    <i class='far fa-heart'></i>
                                                </a>";
                                    }
                                    ?>
                                    
                                    <a href="shop-details.html" class="icon-2">
                                        <img src="../assets/img/icon/shuffle.svg" alt="svg-icon">
                                    </a>
                                </div>
                            </div>
                            </form>
                            
                            <?php 
                                //handle book add to cart
                                if(isset($_POST['quantity'])){
                                    $quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
                                    
                                    require_once("./ShoppingCart/shoppingCartFunctionalities.php");
                                    
                                    addBookToBasket($conn,$row['book_id'],$quantity);
                                }
                            ?>
                            
                            <div class="category-box">
                                <div class="category-list">
                                    <ul>
                                        <li>
                                            <span>ISBN:</span> <?php echo htmlspecialchars($row['isbn']); ?>
                                        </li>
                                        <li>
                                            <span>Genres:</span><br>
                                            <?php 
                                                $genreList = explode(',', $genres);
                                                foreach($genreList as $genre){
                                                    echo '<p>' . htmlspecialchars(trim($genre)) . '</p>';
                                                }
                                            ?>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <span>Authors:</span><br>
                                            <?php 
                                                $authorList = explode(',', $authors);
                                                foreach($authorList as $author){
                                                    echo '<p>' . htmlspecialchars(trim($author)) . '</p>';
                                                }
                                            ?>
                                        </li>
                                        <li>
                                            <span>Format:</span> <?php echo htmlspecialchars($row['format']); ?>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <span>Total Pages:</span> <?php echo htmlspecialchars($row['nr_pages']); ?>
                                        </li>
                                        <li>
                                            <span>Language:</span> <?php echo htmlspecialchars($row['language']); ?>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li>
                                            <span>Publication Year:</span> <?php echo htmlspecialchars($row['publication_year']); ?>
                                        </li>
                                        <li>
                                            <span>Publisher:</span> <?php echo htmlspecialchars($row['publisher']); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="box-check">
                                <div class="check-list">
                                    <ul>
                                        <li>
                                            <i class="fa-solid fa-check"></i>
                                            Free shipping orders from 5000 All
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check"></i>
                                            30 days exchange & return
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-check"></i>
                                            Safe & Secure online shopping
                                        </li>
                                    </ul>
                                </div>
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
                                <h6>reviews</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="description" class="tab-pane fade show active" role="tabpanel">
                            <div class="description-items">
                                <p>
                                    <?php 
                                        echo $row['description'];
                                    ?>
                                </p>    
                            </div>
                        </div>
                        <div id="additional" class="tab-pane fade" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-1">Availability</td>
                                            <td class="text-2">
                                                <?php 
                                                    if($row['format'] == 'For Sale'){
                                                        if($formatRow['inventory'] > 0){
                                                            echo "Available";
                                                        } else {
                                                            echo "Out of Stock";
                                                        }
                                                    } else if($row['format'] == 'For Borrow'){
                                                        if($formatRow['inventory'] > 0){
                                                            echo "Available";
                                                        } else {
                                                            echo "Out of Stock";
                                                        }
                                                    } else {
                                                        echo "Not for Sale";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">ISBN</td>
                                            <td class="text-2"><?php echo $row['isbn']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Authors</td>
                                            <td class="text-2"><?php echo $authors; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Genres</td>
                                            <td class="text-2"><?php echo $genres; ?></td> 
                                        </tr>
                                        <tr>
                                            <td class="text-1">Publish Year</td>
                                            <td class="text-2"><?php echo $row['publication_year']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Publisher</td>
                                            <td class="text-2"><?php echo $row['publisher']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Total Pages</td>
                                            <td class="text-2"><?php echo $row['nr_pages']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Format</td>
                                            <td class="text-2"><?php echo $row['format']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Language</td>
                                            <td class="text-2"><?php echo $row['language']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-1">Price</td>
                                            <td class="text-2">
                                                <?php 
                                                    if(isset($saleRow['price'])) {
                                                        echo number_format($formatRow['price'], 2)." All";
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                                <?php 
                                    //getUserid
                                    if(isset($_SESSION['username'])){
                                        $q="SELECT image_path FROM users WHERE USERNAME=?";
                                        $photo_stm=$conn->prepare($q);
                                        $photo_stm->bind_param("s", $_SESSION['username']);
                                        $photo_stm->execute();
                                        $p_res=$photo_stm->get_result();
                                        
                                        if($p_res->num_rows==1){
                                            $user_photo=$p_res->fetch_assoc();
                                            $photo=$user_photo['image_path'];
                                        }
                                    }
                                ?>
                                 <div id="review" class="tab-pane fade" role="tabpanel">
                                    <div class="review-items">
                                    <?php
                                           $book_id = isset($row['book_id']) ? $row['book_id'] : null;

                                           $reviewQuery = $conn->prepare("SELECT r.*, u.username, u.email 
                                                FROM review r 
                                                JOIN users u ON r.username = u.username 
                                                WHERE r.book_id = ?
                                                ORDER BY r.created_at DESC
                                            ");


                                        $reviewQuery->bind_param("i", $book_id);
                                        $reviewQuery->execute();
                                        $reviews = $reviewQuery->get_result();

                                        while ($r = $reviews->fetch_assoc()):
                                        ?>
                                        <div class="review-wrap-area d-flex gap-4">
                                        <div class="review-thumb">
                                            <img src="../../../uploads/users/<?php echo $photo?>" alt="img" width="50px" height="50px" style="border-radius: 25px;">
                                        </div>

                                        <div class="review-content">
                                        <div class="head-area d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                            <div class="cont">
                                            <h5><?= htmlspecialchars($r['username']) ?> (<?= htmlspecialchars($r['email']) ?>)</h5>
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
                                        <p class="mt-30 mb-4"><?= nl2br(htmlspecialchars($r['comment'])) ?></p>
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
                                            <input type="hidden" name="isbn" value="<?= htmlspecialchars($_GET['isbn'] ?? '') ?>">

                                            <!-- COMMENT -->
                                            <div class="mb-3">
                                                <textarea name="comment" class="form-control" placeholder="Write Message" required></textarea>
                                            </div>

                                            <!-- STAR RATING SYSTEM -->
                                            <div class="mb-3 star-rating">
                                                <input type="hidden" name="rating" id="ratingValue" value="0">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fa-regular fa-star fa-2x star" data-value="<?= $i ?>" style="cursor: pointer;"></i>
                                                <?php endfor; ?>
                                            </div>

                                            

                                            <button type="submit" class="theme-btn style-2" <?php if(!isset($_SESSION['username'])){echo 'disabled';}?>>Submit Review</button>
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
                                <a href="shop-details"><img src="../assets/img/book/01.png" alt="img"></a>
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

                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
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
                                            <img src="../assets/img/testimonial/client-1.png" alt="img">
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
                                            <img src="../assets/img/testimonial/client-2.png" alt="img">
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
                                            <img src="../assets/img/testimonial/client-3.png" alt="img">
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
                                <a href="shop-details"><img src="../assets/img/book/04.png" alt="img"></a>
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

                                            <img class="icon" src="../assets/img/icon/shuffle.svg" alt="svg-icon">
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
                                            <img src="../assets/img/testimonial/client-4.png" alt="img">
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
                                            <img src="../assets/img/testimonial/client-5.png" alt="img">
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
    <?php 
        include("footer.php");
    ?> 


    <!--<< All JS Plugins >>-->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <!--<< Viewport Js >>-->
    <script src="../assets/js/viewport.jquery.js"></script>
    <!--<< Bootstrap Js >>-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--<< Nice Select Js >>-->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <!--<< Waypoints Js >>-->
    <script src="../assets/js/jquery.waypoints.js"></script>
    <!--<< Counterup Js >>-->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <!--<< Swiper Slider Js >>-->
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <!--<< MeanMenu Js >>-->
    <script src="../assets/js/jquery.meanmenu.min.js"></script>
    <!--<< Magnific Popup Js >>-->
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <!--<< Wow Animation Js >>-->
    <script src="../assets/js/wow.min.js"></script>
    <!-- Gsap -->
    <script src="../assets/js/gsap.min.js"></script>
    <!--<< Main.js >>-->
    <script src="../assets/js/main.js"></script>

    

</body>

</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star-rating .star");
    const ratingValue = document.getElementById("ratingValue");
    const ratingSelect = document.getElementById("ratingSelect");

    // Star click handler
    stars.forEach(star => {
        star.addEventListener("click", function () {
            const selected = parseInt(this.getAttribute("data-value"));
            ratingValue.value = selected;

            // Set solid stars up to selected
            stars.forEach(s => {
                const val = parseInt(s.getAttribute("data-value"));
                if (val <= selected) {
                    s.classList.remove("fa-regular");
                    s.classList.add("fa-solid");
                } else {
                    s.classList.remove("fa-solid");
                    s.classList.add("fa-regular");
                }
            });

            // Sync select dropdown if used
            if (ratingSelect) {
                ratingSelect.value = selected;
            }
        });
    });

    // Optional: Sync dropdown with stars
    if (ratingSelect) {
        ratingSelect.addEventListener("change", function () {
            const selected = parseInt(this.value);
            if (!isNaN(selected)) {
                ratingValue.value = selected;

                stars.forEach(s => {
                    const val = parseInt(s.getAttribute("data-value"));
                    if (val <= selected) {
                        s.classList.remove("fa-regular");
                        s.classList.add("fa-solid");
                    } else {
                        s.classList.remove("fa-solid");
                        s.classList.add("fa-regular");
                    }
                });
            }
        });
    }
});
</script>
