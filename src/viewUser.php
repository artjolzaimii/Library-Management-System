<?php
require_once("../utilities/config.php");
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<script>alert('Invalid user ID!'); window.location.href='userManagement.php';</script>";
  exit;
}

$user_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
  echo "<script>alert('User not found!'); window.location.href='userManagement.php';</script>";
  exit;
}

$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-5">
  <h3 class="mb-4">View User Details</h3>
  <div class="card">
    <div class="card-body">
      <p><strong>User ID:</strong> <?= htmlspecialchars($user['user_id']) ?></p>
      <p><strong>Full Name:</strong> <?= htmlspecialchars($user['full_name']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
      <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
      <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
      <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
      <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></p>
      <p><strong>Birthday:</strong> <?= htmlspecialchars($user['birthday']) ?></p>
      <p><strong>Profile Image:</strong><br>
        <?php if ($user['image_path']): ?>
          <img src="../uploads/users/<?= htmlspecialchars($user['image_path']) ?>" alt="User Image" class="img-fluid rounded" style="max-height: 200px; border: 1px solid #ccc; padding: 5px;">
        <?php else: ?>
          No image
        <?php endif; ?>
      </p>
      <a href="userManagement.php" class="btn btn-secondary mt-3">Back to User Management</a>
    </div>
  </div>
</div>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
</body>
</html>

<?php $conn->close(); ?>
