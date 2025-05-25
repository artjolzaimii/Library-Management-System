<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eternal Library Management</title>
</head>
<body>
    
</body>
</html>
<?php
// filepath: c:\xampp\htdocs\Online-Library-Management-System\src\userManagement.php
session_start();
require_once('../utilities/config.php');

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: addUser.php");
    exit;
}

// Handle delete user
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: userManagement.php");
    exit;
}

// Handle edit user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id = (int)$_POST['edit_id'];
    $user_id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Handle image upload
    $image_path = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/users/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $image_name = basename($_FILES["profile_image"]["name"]);
        $target_file = $target_dir . time() . "_" . $image_name;
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    $update_query = "UPDATE users SET user_id=?, full_name=?, email=?, phone=?, address=?, username=?, role=?, gender=?, birthday=?";
    $params = [$user_id, $full_name, $email, $phone, $address, $username, $role, $gender, $birthday];
    $types = "sssssssss";

    if ($password) {
        $update_query .= ", password=?";
        $params[] = $password;
        $types .= "s";
    }
    if ($image_path) {
        $update_query .= ", image_path=?";
        $params[] = $image_path;
        $types .= "s";
    }
    $update_query .= " WHERE id=?";
    $params[] = $edit_id;
    $types .= "i";

    $stmt = $conn->prepare($update_query);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->close();
    header("Location: userManagement.php");
    exit;
}

// Pagination
$usersPerPage = 5;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $usersPerPage;
$totalUsersQuery = "SELECT COUNT(*) AS total FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsersRow = $totalUsersResult->fetch_assoc();
$totalUsers = $totalUsersRow['total'];
$totalPages = ceil($totalUsers / $usersPerPage);
$query = "SELECT * FROM users LIMIT $usersPerPage OFFSET $offset";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User Management | Eternal Library</title>
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
                    <span class="text-muted fw-light">User Management /</span> User Management
                </h4>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>User List</span>
                        <button class="btn btn-primary" onclick="window.location.href='addUser.php'">
                            <i class="bx bx-user-plus"></i> Add New User
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td><?= htmlspecialchars($row['phone']) ?></td>
                                        <td><?= htmlspecialchars($row['username']) ?></td>
                                        <td><?= htmlspecialchars($row['role']) ?></td>
                                        <td>
                                            <!-- View Button -->
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal<?= $row['id'] ?>" title="View">
                                                <i class="bx bx-show"></i>
                                            </button>
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $row['id'] ?>" title="Edit">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                            <!-- Delete Button -->
                                            <a href="userManagement.php?delete_id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- View User Modal -->
                                    <div class="modal fade" id="viewUserModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="viewUserModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewUserModalLabel<?= $row['id'] ?>">View User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>User ID:</strong> <?= htmlspecialchars($row['user_id']) ?></p>
                                                    <p><strong>Full Name:</strong> <?= htmlspecialchars($row['full_name']) ?></p>
                                                    <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                                    <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                                                    <p><strong>Username:</strong> <?= htmlspecialchars($row['username']) ?></p>
                                                    <p><strong>Role:</strong> <?= htmlspecialchars($row['role']) ?></p>
                                                    <p><strong>Gender:</strong> <?= htmlspecialchars($row['gender']) ?></p>
                                                    <p><strong>Birthday:</strong> <?= htmlspecialchars($row['birthday']) ?></p>
                                                    <p><strong>Image:</strong><br>
                                                        <?php
                                                        $imagePath = '';
                                                        if ($row['role'] == 'Client' || $row['role'] == 'User') {
                                                            $imagePath = '../uploads/users/' . $row['image_path'];
                                                        } else {
                                                            $imagePath = '../uploads/users/staff/' . $row['image_path'];
                                                        }
                                                        ?>
                                                        <img src="<?= htmlspecialchars($imagePath) ?>" alt="User Image" class="img-fluid rounded" style="max-height: 200px; border: 1px solid #ccc; padding: 5px;">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUserModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel<?= $row['id'] ?>">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="userManagement.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="edit_id" value="<?= $row['id'] ?>" />
                                                        <div class="mb-3">
                                                            <label for="user_id<?= $row['id'] ?>" class="form-label">User ID</label>
                                                            <input type="text" class="form-control" id="user_id<?= $row['id'] ?>" name="user_id" value="<?= htmlspecialchars($row['user_id']) ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="full_name<?= $row['id'] ?>" class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" id="full_name<?= $row['id'] ?>" name="full_name" value="<?= htmlspecialchars($row['full_name']) ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="profile_image<?= $row['id'] ?>" class="form-label">Profile Image</label><br>
                                                            <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Profile Image" style="height: 50px; border-radius: 50%;">
                                                            <input type="file" class="form-control mt-2" name="profile_image" accept="image/*" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email<?= $row['id'] ?>" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email<?= $row['id'] ?>" name="email" value="<?= htmlspecialchars($row['email']) ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="phone<?= $row['id'] ?>" class="form-label">Phone</label>
                                                            <input type="text" class="form-control" id="phone<?= $row['id'] ?>" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="address<?= $row['id'] ?>" class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="address<?= $row['id'] ?>" name="address" value="<?= htmlspecialchars($row['address']) ?>" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="username<?= $row['id'] ?>" class="form-label">Username</label>
                                                            <input type="text" class="form-control" id="username<?= $row['id'] ?>" name="username" value="<?= htmlspecialchars($row['username']) ?>" required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password<?= $row['id'] ?>" class="form-label">Password (Leave blank to keep current)</label>
                                                            <input type="password" class="form-control" id="password<?= $row['id'] ?>" name="password" placeholder="Enter new password (leave empty to keep current)" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="role<?= $row['id'] ?>" class="form-label">Role</label>
                                                            <select class="form-select" id="role<?= $row['id'] ?>" name="role" required>
                                                                <option value="Librarian" <?= $row['role'] == 'Librarian' ? 'selected' : '' ?>>Librarian</option>
                                                                <option value="Admin" <?= $row['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                                <option value="User" <?= $row['role'] == 'User' ? 'selected' : '' ?>>User</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="gender<?= $row['id'] ?>" class="form-label">Gender</label>
                                                            <select class="form-select" id="gender<?= $row['id'] ?>" name="gender" required>
                                                                <option value="Male" <?= $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                                                <option value="Female" <?= $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                                                <option value="Other" <?= $row['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="birthday<?= $row['id'] ?>" class="form-label">Birthday</label>
                                                            <input type="date" class="form-control" id="birthday<?= $row['id'] ?>" name="birthday" value="<?= htmlspecialchars($row['birthday']) ?>" required />
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update User</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav class="mt-3">
                                <ul class="pagination justify-content-center">
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
<?php $conn->close(); ?>