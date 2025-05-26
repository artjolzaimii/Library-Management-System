<?php
session_start();
require('../utilities/config.php');

$errors = [];
$userId = $fullName = $email = $phone = $address = $username = $role = $gender = $birthday = '';
$profileImage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    $checkUserId = $conn->prepare("SELECT id FROM users WHERE user_id = ?");
    $checkUserId->bind_param("s", $userId);
    $checkUserId->execute();
    $checkUserId->store_result();
    if ($checkUserId->num_rows > 0) {
        $errors[] = "User ID already exists.";
    }

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();
    if ($checkEmail->num_rows > 0) {
        $errors[] = "Email address already exists.";
    }

    $checkUsername = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkUsername->bind_param("s", $username);
    $checkUsername->execute();
    $checkUsername->store_result();
    if ($checkUsername->num_rows > 0) {
        $errors[] = "Username already exists.";
    }

    if (empty($errors) && !empty($_FILES['profile_image']['name'])) {
        $imageName = basename($_FILES['profile_image']['name']);
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $uniqueImageName = uniqid('IMG_', true) . '.' . $imageExt;
        $uploadDir = '../uploads/users/staff/';
        $uploadPath = $uploadDir . $uniqueImageName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
            $profileImage = $uniqueImageName;
        } else {
            $errors[] = "Failed to upload profile image.";
        }
    }


    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO users 
        (user_id, full_name, email, phone, address, username, password, role, gender, birthday, image_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $stmt->bind_param("sssssssssss", $userId, $fullName, $email, $phone, $address, $username, $password, $role, $gender, $birthday, $profileImage);

        if ($stmt->execute()) {
            header("Location: userManagement.php?success=1");
            exit;
        } else {
            $errors[] = "Database error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="layout-container">
  <?php include('../utilities/menu.php'); ?>
  <div class="layout-page">
    <div class="content-wrapper">
      <?php include('../utilities/navbar.php'); ?>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">User Management /</span> Add New User
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-user-add"></i> Add New User</h5>
          <div class="card-body">

            <?php if (!empty($errors)): ?>
              <div class="alert alert-danger">
                <ul class="mb-0">
                  <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <form action="addUser.php" method="POST" enctype="multipart/form-data">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="user_id" class="form-label">User ID</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input type="text" class="form-control" name="user_id" id="user_id" value="<?= htmlspecialchars($userId) ?>" placeholder="Unique User ID" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="profile_image" class="form-label">Profile Image</label>
                  <div class="input-group">
                    <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="fullName" class="form-label">Full Name</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input type="text" class="form-control" name="fullName" id="fullName" value="<?= htmlspecialchars($fullName) ?>" placeholder="Full Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email Address</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($email) ?>" placeholder="Email Address" required>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" class="form-control" name="phone" id="phone" value="<?= htmlspecialchars($phone) ?>" placeholder="Phone Number" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-map"></i></span>
                    <input type="text" class="form-control" name="address" id="address" value="<?= htmlspecialchars($address) ?>" placeholder="Address" required>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="username" class="form-label">Username</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                    <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($username) ?>" placeholder="Username" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="role" class="form-label">Role</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-briefcase"></i></span>
                    <select name="role" id="role" class="form-control" required>
                      <option value="" disabled <?= $role == '' ? 'selected' : '' ?>>Select Role</option>
                      <option value="Librarian" <?= $role == 'Librarian' ? 'selected' : '' ?>>Librarian</option>
                      <option value="Admin" <?= $role == 'Admin' ? 'selected' : '' ?>>Admin</option>
                      <option value="User" <?= $role == 'User' ? 'selected' : '' ?>>User</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="gender" class="form-label">Gender</label>
                  <div class="d-flex align-items-center">
                    <div>
                      <input type="radio" name="gender" value="Male" <?= $gender == 'Male' ? 'checked' : '' ?> required> Male
                      <input type="radio" name="gender" value="Female" <?= $gender == 'Female' ? 'checked' : '' ?> required> Female
                      <input type="radio" name="gender" value="Other" <?= $gender == 'Other' ? 'checked' : '' ?> required> Other
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="birthday" class="form-label">Birthday</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?= htmlspecialchars($birthday) ?>" required>
                  </div>
                </div>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save User</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>