<?php
require('../utilities/config.php');

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

    // Handle image upload
    $profileImage = '';
    if (!empty($_FILES['profile_image']['name'])) {
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
            echo "Failed to upload image.";
            exit;
        }
    }

    $query = "INSERT INTO users (user_id, full_name, email, phone, address, username, password, role, gender, birthday, image_path)
              VALUES ('$userId', '$fullName', '$email', '$phone', '$address', '$username', '$password', '$role', '$gender', '$birthday', '$profileImage')";

    if (mysqli_query($conn, $query)) {
        echo "User added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            <form action="addUser.php" method="POST" enctype="multipart/form-data">
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="user_id" class="form-label">User ID</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Unique User ID" required>
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
                    <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Full Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email Address</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                  </div>
                </div>
              </div>
              
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-map"></i></span>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="username" class="form-label">Username</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
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
                      <option value="" selected disabled>Select Role</option>
                      <option value="Librarian">Librarian</option>
                      <option value="Admin">Admin</option>
                      <option value="User">User</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="gender" class="form-label">Gender</label>
                  <div class="d-flex align-items-center">
                    <div>
                      <input type="radio" name="gender" value="Male" required> Male
                      <input type="radio" name="gender" value="Female" required> Female
                      <input type="radio" name="gender" value="Other" required> Other
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="birthday" class="form-label">Birthday</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="date" class="form-control" name="birthday" id="birthday" required>
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
