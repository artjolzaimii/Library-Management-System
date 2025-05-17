<!-- Header Section Start -->
<?php 
    include("clientMenu.php");
    include("../../../utilities/config.php")
?><!DOCTYPE html>
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
                                    <a target="_blank" href="checkout.html">Main Street, Melbourne, Australia</a>
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
                                    <a target="_blank" href="checkout.html">Mod-friday, 09am -05pm</a>
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
                <h1>Checkout</h1>
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
                            Checkout
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Section Start -->
    <section class="checkout-section fix section-padding pb-0">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-9">
                    <form action="#" method="post">
                        <div class="checkout-single-wrapper">
                            <div class="checkout-single boxshado-single">
                                <h4>Billing Details</h4>
                                <div class="checkout-single-form">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="input-single">
                                                <span>First Name*</span>
                                                <input type="text" name="user-first-name" id="userFirstName" required=""
                                                    placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-single">
                                                <span>Last Name*</span>
                                                <input type="text" name="user-last-name" id="userLastName" required=""
                                                    placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Company name (optional)</span>
                                                <input name="company-name" id="companyname">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Country*</span>
                                                <input name="country" id="country" placeholder="Select a country">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Street Address*</span>
                                                <input name="user-address" id="userAddress"
                                                    placeholder="Home number and street name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Street Address*</span>
                                                <input name="user-address" id="userAddress2"
                                                    placeholder="Apartment, suite, unit, etc. (optional)">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Town/ City*</span>
                                                <input name="towncity" id="towncity">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Phone*</span>
                                                <input name="phone" id="phone" placeholder="phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>Email Address*</span>
                                                <input name="email" id="email22" placeholder="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-check payment-save">
                                                <input type="checkbox" class="form-check-input" name="save-for-next"
                                                    id="saveForNext">
                                                <label for="saveForNext">Save for my next payment</label>
                                            </div>
                                            <div class="input-check payment-save style-2">
                                                <input type="checkbox" class="form-check-input" name="ship-to-different"
                                                    id="saveForNext2">
                                                <label for="saveForNext2">Ship to a different address?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="input-single">
                                                <span>order notes (optional)</span>
                                                <textarea name="notes" id="notes"
                                                    placeholder="Notes about your order, e.g special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3">
                    <div class="checkout-order-area">
                        <h3>Our Order</h3>
                        <div class="product-checout-area">
                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                <p>Product</p>
                                <p>Subtotal</p>
                            </div>
                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                <p>Fashion Women’s 1</p>
                                <p>$29.00</p>
                            </div>
                            <div class="checkout-item d-flex justify-content-between">
                                <p>Shipping</p>
                                <div class="shopping-items">
                                    <div class="form-check d-flex align-items-center from-customradio">
                                        <label class="form-check-label">
                                            Free Shipping
                                        </label>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault12">
                                    </div>
                                    <div class="form-check d-flex align-items-center from-customradio">
                                        <label class="form-check-label">
                                            Local: $15.00
                                        </label>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault123">
                                    </div>
                                    <div class="form-check d-flex align-items-center from-customradio">
                                        <label class="form-check-label">
                                            Flat rate: $10.00
                                        </label>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault124">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout-item d-flex align-items-center justify-content-between">
                                <p>Total</p>
                                <p>$55.00</p>
                            </div>
                            <div class="checkout-item-2">
                                <div class="form-check-2 d-flex align-items-center from-customradio-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1222">
                                    <label class="form-check-label" for="flexRadioDefault1222">
                                        Direct bank transfer
                                    </label>
                                </div>
                                <p>
                                    Make your payment directly into our bank account please use your Order ID as the
                                    payment reference. Your order will not be shipped until the funds have cleared in
                                    our account.
                                </p>
                                <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault12224">
                                    <label class="form-check-label" for="flexRadioDefault12224">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="form-check-3 d-flex align-items-center from-customradio-2 mt-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault12225">
                                    <label class="form-check-label" for="flexRadioDefault12225">
                                        Paypal
                                    </label>
                                    <ul class="brand-logo">
                                        <li>
                                            <a href="checkout.html">
                                                <img src="assets/img/PayPal.png" alt="img">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="checkout.html">
                                                <img src="assets/img/GooglePay.png" alt="img">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="checkout.html">
                                                <img src="assets/img/Mastercard2.png" alt="img">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
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
</body>

</html>