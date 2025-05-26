<!-- Header Section Start -->
<?php 
    include("clientMenu.php");
    include("../../../utilities/config.php");
    require_once("wishlistFunctionality.php");
    if(!isset($_SESSION['username'])&& !isset($_GET['add'])){
        echo "<script>window.location.href =\"mainPage.php\"</script>";
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
    <meta name="description" content="Boimela - Books Library eCommerce Store">
    <?php
        require("styleAndScripts.php");
    ?>
</head>

<body>
    <!-- Cursor follower -->
    <div class="cursor-follower"></div>

    <!-- Preloader start -->
     <?php include("loading.php") ?>

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
                            <a href="mainPage.php">
                                <img src="uploads/authors/1747584125_author.jpg" alt="logo-img">
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
                                    <a target="_blank" href="wishlist.html">Main Street, Melbourne, Australia</a>
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
                                    <a target="_blank" href="wishlist.html">Mod-friday, 09am -05pm</a>
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
                <h1>Wishlist</h1>
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
                            Wishlist
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <?php 
        //handle add to cart
        require_once("./ShoppingCart/shoppingCartFunctionalities.php");
        if(isset($_GET['add'])){
            addBookToBasket($conn,$_GET['add'],1);
        }
    ?>
    <!-- Shop Cart Section Start -->
     <!-- Fetching the wishlist books from the database -->
    <?php 
        $username = $_SESSION['username'];
        
        $userQuery = "SELECT id FROM users WHERE username = ?";
        $userStmt = $conn->prepare($userQuery);
        $userStmt->bind_param("s", $username);
        $userStmt->execute();
        $userId = $userStmt->get_result()->fetch_assoc()['id'];

        $query = "SELECT b.*, sb.price, sb.inventory 
             FROM book b
             INNER JOIN sale_book sb ON b.book_id = sb.book_id
             INNER JOIN wishlist w ON w.book_id = b.book_id
             WHERE w.user_id = ?";
        
        $stm = $conn->prepare($query);
        $stm->bind_param("i", $userId);
        $stm->execute();
        
        $result = $stm->get_result();

        // Wishlist empty
        if ($result->num_rows === 0) {
            echo '<div class="alert alert-info">Your wishlist is empty</div>';
        }
    ?>
    
    
    
    <div class="cart-section section-padding pb-0">
        <div class="container">
            <div class="main-cart-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    while($book = $result->fetch_assoc()):
                                        $stockStatus = $book['inventory'] > 0 ? 'In Stock' : 'Out Of Stock';
                                        $stockClass = $book['inventory'] > 0 ? 'stock-title' : 'stock-title-two';
                                ?>
                                    <tr>
                                        <td>
                                            <span class="d-flex gap-5 align-items-center">
                                                <a href="wishlist.php?remove=<?php echo $book['book_id']?>" class="remove-icon">
                                                    <img src="../assets/img/icon/icon-9.svg" alt="img">
                                                </a>
                                                <span class="cart">
                                                    <img src="<?php echo "../../../uploads/images/".$book['image_path']?>" alt="img" style="height:100px; width:70px;">
                                                </span>
                                                <span class="cart-title">
                                                    <?php echo $book['title'];?>
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="cart-price"><?php echo $book['price']?> All</span>
                                        </td>
                                        <td>
                                            <span class="<?php echo $stockClass?>">
                                                <?php echo $stockStatus?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($book['inventory'] > 0): ?>
                                            <a href="wishlist.php?add=<?php echo $book['book_id']?>" class="theme-btn">Add to Cart</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Handle remove from wishlist
    if(isset($_GET['remove'])){
        $bookId = mysqli_real_escape_string($conn, $_GET['remove']);
        $username = $_SESSION['username'];

        $userId = getUserId($username);
        
        $query = "DELETE FROM wishlist 
                 WHERE book_id=? AND user_id=?";
        $stm = $conn->prepare($query);
        $stm->bind_param("ii", $bookId, $userId);
        $stm->execute();        if($conn->affected_rows > 0){
            echo '<script>
                alert("Book removed from wishlist successfully");
                window.location.href = "wishlist.php";
            </script>';
        }
    }

    //Handle add to wishlist
    if (isset($_GET['add'])) {        if (!isset($_SESSION['username'])) {
            echo '<script>
                alert("Please login to add to wishlist");
                window.location.href = "mainPage.php";
            </script>';
        } else {
            $book_id = intval($_GET['add']);
            $username = $_SESSION['username'];

            // Get User ID 
            $user_id = getUserId($username);            if(isInWishlist($book_id, $user_id)) {
                echo '<script>
                    alert("Book is already in your wishlist");
                    window.location.href = "shopList.php";
                </script>';            } else {
                $result = addToWishlist($book_id, $user_id);
                echo '<script>
                    alert("'.$result['message'].'");
                    window.location.href = "shopList.php";
                </script>';
            }
        }
    }
    ?>

    <!-- Footer Section start  -->
    <?php 
        include("footer.php");
    ?>

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