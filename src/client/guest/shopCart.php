<!-- Header Section Start -->
<?php 
    include("clientMenu.php");
    include("../../../utilities/config.php");
    if(!isset($_SESSION['username'])){
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
    <meta name="description" content="Boimela - Books Library eCommerce Store">
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
                                    <a target="_blank" href="shop-cart.html">Main Street, Melbourne, Australia</a>
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
                                    <a target="_blank" href="shop-cart.html">Mod-friday, 09am -05pm</a>
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
                <h1>Cart</h1>
                <div class="page-header">
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                        <li>
                            <a href="index.html">
                                Home
                            </a>
                        </li>
                        <li>
                            <i class="fa-solid fa-chevron-right"></i>
                        </li>
                        <li>
                            Cart
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Cart Section Start -->
    <?php 
        $cartId=getShopCartId($conn);
        
        $query=
        "
        SELECT book.image_path, book.title, quantity, price, book.book_id
        FROM book INNER JOIN sale_book ON sale_book.book_id=book.book_id
        INNER JOIN cart_book ON cart_book.book_id=book.book_id
        INNER JOIN shopping_cart ON shopping_cart.cart_id=cart_book.cart_id
        WHERE cart_book.cart_id=?
        ";
        
        $stm=$conn -> prepare($query);
        $stm->bind_param("i",$cartId);
        $stm->execute();
        
        $result=$stm->get_result();
        
    ?>
    <div class="cart-section section-padding pb-0">
        <div class="container">
            <div class="main-cart-wrapper">
                <div class="row g-5">
                    <div class="col-xl-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $total=0;
                                    
                                    //Start printing books in shopcart
                                    while($book=$result ->fetch_assoc()):
                                        $total+=$book['price']*$book['quantity'];
                                        
                                ?>
                                    <tr>
                                        <td>
                                            <span class="d-flex gap-3 align-items-center">
                                                <a href="shopCart.php?id=<?php echo $book['book_id']?>" class="remove-icon">
                                                    <img src="../assets/img/icon/icon-9.svg" alt="img">
                                                </a>
                                                <img src="<?php echo "../../../uploads/images/".$book['image_path']?>" alt="img" height="100px" width="70px">
                                                <span class="cart-title">
                                                    <?php echo $book['title'];?>
                                                </span>
                                            </span>
                                        <td>
                                            <span class="cart-price"><?php echo $book['price']?> All</span>
                                        </td>
                                        <td>
                                            <span class="quantity-basket">
                                                <span class="qty">
                                                    <button class="qtyminus" aria-hidden="true">−</button>
                                                    <input type="number" name="quantity" class="qty-input" min="1" max="10" step="1"
                                                        value="<?php echo $book['quantity']?>" data-book-id="<?php echo $book['book_id']; ?>">
                                                    <button class="qtyplus" aria-hidden="true">+</button>
                                                </span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="subtotal-price"><?php echo $book['quantity']* $book['price']?> All</span>
                                        </td>
                                    </tr>
                                <?php endwhile;?>
                                <!-- Delete query -->
                                <?php 
                                    if(isset($_GET['id'])){
                                        $bookId=mysqli_real_escape_string($conn,$_GET['id']);
                                        $cartId=getShopCartId($conn);
                                        $query=
                                        "
                                            DELETE FROM cart_book WHERE book_id=? AND cart_id=?
                                        ";
                                        $stm=$conn->prepare($query);
                                        $stm->bind_param("ii",$bookId,$cartId);
                                        $stm->execute();
                                        
                                        if($conn->affected_rows>0){
                                            echo "<script>window.location.href=\"shopCart.php\"</script>";
                                        }
                                        
                                    }
                                ?>    
                            
                                <!-- Updating quantity script for AJAX-->
                                <?php
                                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'], $_POST['quantity'])) {
                                        $bookId = (int)$_POST['book_id'];
                                        $quantity = (int)$_POST['quantity'];
                                        $cartId = getShopCartId($conn);
                                        $stmt = $conn->prepare("UPDATE cart_book SET quantity = ? WHERE book_id = ? AND cart_id=?");
                                        $stmt->bind_param("iii", $quantity, $bookId, $cartId);
                                        $stmt->execute();

                                    }
                                    ?>
    
                                <script>
                                    //plus/minus
                                    document.querySelectorAll('.qtyminus').forEach(btn => {
                                        btn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            const input = this.nextElementSibling;
                                            let value = parseInt(input.value, 10);
                                            if (value > parseInt(input.min, 10)) {
                                                input.value = value - 1;
                                                input.dispatchEvent(new Event('change'));
                                            }
                                        });
                                    });
                                    
                                    document.querySelectorAll('.qtyplus').forEach(btn => {
                                        btn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            const input = this.previousElementSibling;
                                            let value = parseInt(input.value, 10);
                                            if (value < parseInt(input.max, 10)) {
                                                input.value = value + 1;
                                                input.dispatchEvent(new Event('change'));
                                            }
                                        });
                                    });
                                
                                    document.querySelectorAll('.qty-input').forEach(input => {
                                        input.addEventListener('change', function () {
                                            const bookId = this.dataset.bookId;
                                            const quantity = this.value;

                                            fetch("", { 
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded"
                                                },
                                                body: "book_id=" + bookId + "&quantity=" + quantity
                                            })
                                            .then(res => {
                                                window.location.href="shopCart.php"
                                            })
                                            
                                        });
                                    });
                                </script>

                                </tbody>
                            </table>
                        </div>
                        <div class="cart-wrapper-footer">
                            <a href="shopList.php" class="theme-btn">
                                Update Cart
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="table-responsive cart-total">
                            <table class="table style-2">
                                <thead>
                                    <tr>
                                        <th>Cart Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="d-flex gap-5 align-items-center justify-content-between">
                                                <span class="sub-title">Subtotal:</span>
                                                <span class="sub-price"><?php echo $total?>All</span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="d-flex gap-5 align-items-center  justify-content-between">
                                                <span class="sub-title">Shipping:</span>
                                                <span class="sub-text">
                                                    Free
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="d-flex gap-5 align-items-center  justify-content-between">
                                                <span class="sub-title">Total: </span>
                                                <span class="sub-price sub-price-total"><?php echo $total?>All</span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="checkout.php" class="theme-btn style-2">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Footer Section start  -->
    <?php 
        include("footer.php");
    ?>
</body>

</html>