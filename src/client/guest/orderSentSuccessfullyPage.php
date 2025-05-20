<?php
    include("styleAndScripts.php"); 
    include("clientMenu.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success - Eterna Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php 
        include("loading.php");
    ?>
    <div class="breadcrumb-wrapper bg-cover section-padding" style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading text-center">
                <h1 class="mb-4">Thank You for Your Order!</h1>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <div class="success-icon mb-4" style="font-size:64px; color:#4ade80;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="success-message mb-4" style="font-size:1.2rem; color:#475569;">
                        Your order has been placed successfully.<br>
                        We appreciate your trust in <b>Eterna Library</b>.<br>
                        You will receive an email confirmation soon.
                    </div>
                    <a href="shopList.php" class="theme-btn style-2 mb-2">Continue Shopping</a>
                    <a href="mainPage.php" class="theme-btn" style="background:#6366f1;">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>