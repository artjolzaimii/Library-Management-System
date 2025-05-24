<?php 
    ob_start();
    if (session_status() === PHP_SESSION_NONE) session_start();
    
?>

<header id="header-sticky" class="header-1">
        <?php 
                require_once("./styleAndScripts.php");
        ?>
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
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shopList.php">
                                            Shop List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mainPage.php#borrow">For Borrow</a>
                                    </li>
                                    <li>
                                        <a href="mainPage.php#ebook">E-Books</a>
                                    </li>
                                    <?php 
                                        if(isset($_SESSION['username'])):
                                    ?>
                                    <li class="has-dropdown">
                                        <a href="about.html">
                                            My Orders
                                        </a>
                                    </li>
                                    
                                    <?php 
                                        endif;
                                    ?>
                                    <li>
                                        <a href="mainPage.phpS#authors">
                                            Authors
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mainPage.php#bestseller">Bestseller</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-right d-flex justify-content-end align-items-center">
                    
                        <ul class="header-icon">
                            <li>
                                <a href="#"><i class="fa-regular fa-heart"></i><span class="number">4</span></a>
                            </li>
                        </ul>
                        
                        <!-- Shopping cart -->
                        <?php 
                            include("./ShoppingCart/basket.php");
                        ?>
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
                                    <ul class="dropdown-menu dropdown-menu-end" id="dropdown" aria-labelledby="profileDropdown">
                                        <li><a class="dropdown-item" href="clientProfile.php"><i class="fa fa-user me-2"></i>My Profile</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="logOut.php?token=<?= $_SESSION['token']?>" method="post" style="margin:0;">
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
