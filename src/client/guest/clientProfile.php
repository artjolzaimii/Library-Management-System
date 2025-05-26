<?php
include_once("clientMenu.php");
require_once("../../../utilities/config.php");

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: guest/mainPage.php");
    exit();
}

// Fetch user info
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

//password change
if (isset($_POST['change_password'])) {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($current) || empty($new) || empty($confirm)) {
        $_SESSION['pw_error'] = "All fields are required.";
    } elseif (!password_verify($current, $user['password'])) {
        $_SESSION['pw_error'] = "Current password is incorrect.";
    } elseif (strlen($new) < 6) {
        $_SESSION['pw_error'] = "New password must be at least 6 characters.";
    } elseif ($new !== $confirm) {
        $_SESSION['pw_error'] = "New passwords do not match.";
    } else {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
        $stmt->bind_param("ss", $hash, $username);
        if ($stmt->execute()) {
            $_SESSION['pw_success'] = "Password updated successfully.";
        } else {
            $_SESSION['pw_error'] = "Failed to update password.";
        }
        $stmt->close();
    }
    header("Location: clientProfile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Eternal Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php 
        include("./styleAndScripts.php")
    ?>
</head>
<body>
    <!-- Preloader Start -->
    <?php require("loading.php"); ?>

    <!-- Back To Top start -->
    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>My Profile</h1>
                <div class="page-header">
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                        <li>
                            <a href="mainPage.php">Home</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-chevron-right"></i>
                        </li>
                        <li>My Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="section-padding">
        <div class="container" style="max-width:600px;">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="<?= !empty($user['image_path']) ? '../../../uploads/users/' . htmlspecialchars($user['image_path']) : 'assets/img/user.png' ?>"
                             alt="Profile Image"
                             class="rounded-circle"
                             style="width:120px;height:120px;object-fit:cover;border:4px solid #eee;">
                        <h3 class="mt-3"><?= htmlspecialchars($user['full_name']) ?></h3>
                        <span class="badge bg-primary"><?= htmlspecialchars($user['role']) ?></span>
                    </div>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">
                            <i class="fa fa-user me-2"></i>
                            <strong>Username:</strong> <?= htmlspecialchars($user['username']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-envelope me-2"></i>
                            <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-phone me-2"></i>
                            <strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-map-marker-alt me-2"></i>
                            <strong>Address:</strong> <?= htmlspecialchars($user['address']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-venus-mars me-2"></i>
                            <strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-birthday-cake me-2"></i>
                            <strong>Birthday:</strong> <?= htmlspecialchars($user['birthday']) ?>
                        </li>
                    </ul>
                    <div class="text-center">
                        <a href="mainPage.php" class="theme-btn">Back to Home</a>
                    </div>
                </div>
            </div>

            <!-- Password Change -->
            <div class="card shadow mt-4">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <span class="badge bg-primary" style="font-size:1rem;">
                            <i class="fa fa-key me-2"></i> Change Password
                        </span>
                    </div>
                    <?php
                    // Show feedback messages
                    if (isset($_SESSION['pw_success'])) {
                        echo '<div class="alert alert-success text-center">'.htmlspecialchars($_SESSION['pw_success']).'</div>';
                        unset($_SESSION['pw_success']);
                    }
                    if (isset($_SESSION['pw_error'])) {
                        echo '<div class="alert alert-danger text-center">'.htmlspecialchars($_SESSION['pw_error']).'</div>';
                        unset($_SESSION['pw_error']);
                    }
                    ?>
                    <form method="post" action="" class="px-2">
                        <div class="mb-3">
                            <label for="current_password" class="form-label"><i class="fa fa-lock me-1"></i>Current Password</label>
                            <input type="password" class="form-control rounded-pill" name="current_password" id="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label"><i class="fa fa-lock-open me-1"></i>New Password</label>
                            <input type="password" class="form-control rounded-pill" name="new_password" id="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label"><i class="fa fa-lock me-1"></i>Confirm New Password</label>
                            <input type="password" class="form-control rounded-pill" name="confirm_password" id="confirm_password" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="change_password" class="theme-btn" style="min-width:180px;">
                                <i class="fa fa-save me-1"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("./footer.php"); ?>

</body>
</html>