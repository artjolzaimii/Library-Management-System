<?php 
    ob_start();
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once("../../../utilities/config.php");
?>

<header id="header-sticky" class="header-1">
        <div class="container-fluid">
            <div class="mega-menu-wrapper">
                <div class="header-main">
                    <div class="logo">
                        <a href="mainPage.php" class="header-logo">
                            <img src="../assets/img/logo/logo2.png" alt="logo-img" style="width: 200px; height: auto;">
                        </a>
                        <a href="mainPage.php" class="header-logo-2 d-none">
                            <img src="../assets/img/logo/logo2.png" alt="logo-img" style="width: 200px; height: auto;">
                        </a>
                    </div>
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li>
                                        <a href="mainPage.php">
                                            Home
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="index.html">Home 01</a></li>
                                            <li><a href="index-2.html">Home 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="shop.html">
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
                                        <a href="about.html">
                                            Pages
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="about.html">About Us</a></li>
                                            <li class="has-dropdown">
                                                <a href="team.html">
                                                    Author
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="team.html">Author</a></li>
                                                    <li><a href="team-details.html">Author Profile</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="faq.html">Faq's</a></li>
                                            <li><a href="404.html">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="news.html">
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
                                        <img src="../assets/img/shop-cart/01.png" alt="image">
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
                                        <img src="../assets/img/shop-cart/02.png" alt="image">
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
                        <div class="content">
                            <?php if (isset($_SESSION['username'])): ?>
                                <div class="dropdown profile-dropdown d-inline-block">
                                    <button class="account-text d-flex align-items-center gap-2 dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background:none; border:none;">
                                        <i class="fa-regular fa-user"></i>
                                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                        <li><a class="dropdown-item" href="myProfile.php"><i class="fa fa-user me-2"></i>My Profile</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="logout.php" method="post" style="margin:0;">
                                                <button type="submit" class="dropdown-item"><i class="fa fa-sign-out-alt me-2"></i>Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <button id="openButton" class="account-text d-flex align-items-center gap-2">
                                    <i class="fa-regular fa-user"></i>
                                    Log in
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>