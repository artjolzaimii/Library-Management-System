<?php
require('../utilities/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = 'Librarian'; 
  
    $query = "INSERT INTO users ( full_name, email, phone, address, username, password, role) 
              VALUES ('$fullName', '$email', '$phone', '$address', '$username', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "User added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Genre Management | BookNoW Admin</title>

  <!-- CSS Links -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <div class="layout-container">
    <?php include('../utilities/menu.php')?>

    <div class="layout-page">
      <div class="content-wrapper">
        <?php include('../utilities/navbar.php');?>
        <div class="container-xxl flex-grow-1 container-p-y">

          <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Book Management /</span> Genre Management
          </h4>

  <div class="container mt-5">
    <h2>Add New Librarian</h2>
    <form action="addUser.php" method="POST">
      <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="fullName" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Phone Number</label>
        <input type="text" name="phone" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Address</label>
        <input type="text" name="address" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Add User</button>
    </form>
  </div>
</body>
</html>
