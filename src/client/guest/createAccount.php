<?php 
    include("clientMenu.php"); 
    require_once("../../../utilities/config.php");
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="pixel-plus">
    <meta name="description" content="Boimela - Books Library eCommerce Store">
    <!-- ======== Page title ============ -->
    <title>Eternal Library - Create Account</title>
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
    <!-- Preloader Start -->
    <?php require("loading.php"); ?>

    <!-- Back To Top start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <!-- Offcanvas/Menu Area start  -->
    <div class="fix-area">
        
        
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Sidebar Area Here -->
    <?php include("logInSidebar.php"); ?>

    <!-- Breadcumb Section Start -->
    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>Create Account</h1>
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
                            Create Account
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once("../../../utilities/config.php");
    $error = '';
    $success = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = uniqid('user_');
        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $role = 'Client';
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $image_path = '';

        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "../../../uploads/users/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $file_name;
            }
        }

        if(!$full_name || !$email || !$username || !$password || !$gender) {
            $error = "Please fill in all required fields.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email=? OR username=?");
            $stmt->bind_param("ss", $email, $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error = "Email or Username already exists.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (user_id, full_name, email, phone, address, username, password, role, gender, birthday, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $user_id, $full_name, $email, $phone, $address, $username, $hashed_password, $role, $gender, $birthday, $image_path);
                if ($stmt->execute()) {
                    $id=$conn->insert_id;
                    $shoppingCartQuery="INSERT INTO shopping_cart(`user_id`) VALUES ('$id');"; // create shopping card for this user
                    mysqli_query($conn,$shoppingCartQuery);
                    $success = "Account created successfully! You can now login.";
                } else {
                    $error = "Error creating account. Please try again.";
                }
            }
            $stmt->close();
        }
    }
?>

    <!-- Main Section Start -->
    <section class="section-padding">
        <div class="container" style="max-width:600px;">
            <h2 class="mb-4 text-center">Create Your Account</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-12">
                    <label for="full_name" class="form-label">Full Name *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                        <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="username" class="form-label">Username *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required minlength="6">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="" selected disabled>Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="birthday" class="form-label">Birthday</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="image" class="form-label">Profile Image</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-image"></i></span>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="theme-btn">Create Account</button>
                </div>
            </form>
            
        </div>
    </section>

    <!-- Footer Section start  -->
    <?php include("footer.php"); ?>

        <!--<< All JS Plugins >>-->
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <!--<< Viewport Js >>-->
    <script src="../assets/js/viewport.jquery.js"></script>
    <!--<< Bootstrap Js >>-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--<< Nice Select Js >>-->
    <!--<script src="../assets/js/jquery.nice-select.min.js"></script> -->
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