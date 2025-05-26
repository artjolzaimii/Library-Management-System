<?php
require_once("../utilities/config.php");
session_start();

if (!isset($_GET['id'])) {
  die("No user ID provided.");
}

$user_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
  die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="modal-dialog modal-lg mt-5">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Edit User</h5>
    </div>

    <form action="userManagement.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">User ID</label>
            <input type="text" class="form-control" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea class="form-control" name="address"><?= htmlspecialchars($user['address']) ?></textarea>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Password (leave blank to keep current)</label>
            <input type="password" class="form-control" name="password" placeholder="Enter new password (optional)">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
              <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
              <option value="Librarian" <?= $user['role'] === 'Librarian' ? 'selected' : '' ?>>Librarian</option>
              <option value="User" <?= $user['role'] === 'User' ? 'selected' : '' ?>>User</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
              <option value="Male" <?= $user['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
              <option value="Female" <?= $user['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
              <option value="Other" <?= $user['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Birthday</label>
            <input type="date" class="form-control" name="birthday" value="<?= $user['birthday'] ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label">Profile Image</label>
            <input type="file" class="form-control" name="profile_image">
            <?php if ($user['image_path']): ?>
              <small class="text-muted">Current: <?= htmlspecialchars($user['image_path']) ?></small>
            <?php endif; ?>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <a href="userManagement.php" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
</body>
</html>
<?php $conn->close(); ?>
