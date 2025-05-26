<?php
require_once("../utilities/config.php");
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: client/guest/mainPage.php");
    exit();
}

// Fetch user data
$username = $_SESSION['username'];
$query = "SELECT full_name, username, email, gender,phone, address, birthday, role FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$loggedUser = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Profile</title>
    <link href="assets/vendor/css/core.css" rel="stylesheet" />
    <link href="assets/vendor/css/theme-default.css" rel="stylesheet" />
    <link href="assets/css/demo.css" rel="stylesheet" />
    <link href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" />
</head>
<body>
<div class="layout-container">
    <?php include('../utilities/menu.php'); ?>
    <div class="layout-page">
        <div class="content-wrapper">
            <?php include('../utilities/navbar.php'); ?>
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../uploads/users/staff/<?php echo htmlspecialchars($user['image_path'] ?: 'assets/img/avatars/1.png'); ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name:</label>
                                <div><?php echo htmlspecialchars($loggedUser['full_name']); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">E-mail:</label>
                                <div><?php echo htmlspecialchars($loggedUser['email']); ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number:</label>
                                <div><?php echo htmlspecialchars($loggedUser['phone']); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Address:</label>
                                <div><?php echo htmlspecialchars($loggedUser['address']); ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Gender:</label>
                                <div><?php echo htmlspecialchars($loggedUser['gender']); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Birthday:</label>
                                <div><?php echo htmlspecialchars($loggedUser['birthday']); ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Username:</label>
                                <div><?php echo htmlspecialchars($loggedUser['username']); ?></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Role:</label>
                                <div><?php echo htmlspecialchars($loggedUser['role']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>