<?php
require_once("../utilities/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Management</title>
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
          <span class="text-muted fw-light">Admin /</span> User Management
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-user"></i> User Management</h5>
          <div class="card-body">
            <div class="col mb-12 d-flex justify-content-end">
              <button class="btn btn-primary" onclick="window.location.href='addUser.php'">
                <i class="bx bx-user-plus"></i> Add New User
              </button>
            </div>

            <div class="table-responsive text-nowrap mt-3">
              <input type="text" id="searchBar" class="form-control mb-3" placeholder="Search users...">

              <?php
              $perPage = 5;
              $totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
              $nrPages = ceil($totalUsers / $perPage);
              $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
              $currentPage = max(1, min($nrPages, $currentPage));
              $startPos = ($currentPage - 1) * $perPage;

              $stmt = $conn->prepare("SELECT * FROM users LIMIT ?, ?");
              $stmt->bind_param("ii", $startPos, $perPage);
              $stmt->execute();
              $result = $stmt->get_result();
              ?>

              <table class="table table-hover">
                <thead>
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
                    <td><span class="badge bg-label-primary"><?= htmlspecialchars($row['role']) ?></span></td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewUserModal<?= $row['id'] ?>"><i class="bx bx-show"></i></button>
                      <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editUserModal<?= $row['id'] ?>"><i class="bx bx-pencil"></i></button>
                      <a href="deleteUser.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?');"><i class="bx bx-trash"></i></a>
                    </td>
                  </tr>

                  <!-- View Modal -->
                  <div class="modal fade" id="viewUserModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">View User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <p><strong>User ID:</strong> <?= htmlspecialchars($row['user_id']) ?></p>
                          <p><strong>Full Name:</strong> <?= htmlspecialchars($row['full_name']) ?></p>
                          <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                          <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                          <p><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
                          <p><strong>Username:</strong> <?= htmlspecialchars($row['username']) ?></p>
                          <p><strong>Role:</strong> <?= htmlspecialchars($row['role']) ?></p>
                          <p><strong>Gender:</strong> <?= htmlspecialchars($row['gender']) ?></p>
                          <p><strong>Birthday:</strong> <?= htmlspecialchars($row['birthday']) ?></p>
                          <?php if ($row['image_path']): ?>
                            <p><strong>Image:</strong><br>
                              <img src="../uploads/users/<?= htmlspecialchars($row['image_path']) ?>" alt="Profile Image" class="img-fluid rounded" style="max-height: 200px;">
                            </p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>

                 <!-- Edit Modal -->
                        <div class="modal fade" id="editUserModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <!-- FIX: Point the form to update-user.php -->
                            <form action="update-user.php" method="POST" enctype="multipart/form-data">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="edit_id" value="<?= $row['id'] ?>">

                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label>User ID</label>
                                <input type="text" class="form-control" name="user_id" value="<?= htmlspecialchars($row['user_id']) ?>" required>
                              </div>
                              <div class="col-md-6">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="full_name" value="<?= htmlspecialchars($row['full_name']) ?>" required>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
                              </div>
                              <div class="col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($row['phone']) ?>">
                              </div>
                            </div>

                            <div class="mb-3">
                              <label>Address</label>
                              <textarea class="form-control" name="address"><?= htmlspecialchars($row['address']) ?></textarea>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($row['username']) ?>" required>
                              </div>
                              <div class="col-md-6">
                                <label>Password (leave blank to keep current)</label>
                                <input type="password" class="form-control" name="password" placeholder="New password (optional)">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label>Role</label>
                                <select name="role" class="form-select">
                                  <option value="Admin" <?= $row['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                                  <option value="Librarian" <?= $row['role'] === 'Librarian' ? 'selected' : '' ?>>Librarian</option>
                                  <option value="User" <?= $row['role'] === 'User' ? 'selected' : '' ?>>User</option>
                                </select>
                              </div>
                              <div class="col-md-6">
                                <label>Gender</label>
                                <select name="gender" class="form-select">
                                  <option value="Male" <?= $row['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                                  <option value="Female" <?= $row['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                                  <option value="Other" <?= $row['gender'] === 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label>Birthday</label>
                                <input type="date" class="form-control" name="birthday" value="<?= $row['birthday'] ?>">
                              </div>
                              <div class="col-md-6">
                                <label>Profile Image</label>
                                <input type="file" class="form-control" name="profile_image">
                                <?php if ($row['image_path']): ?>
                                  <small class="text-muted">Current: <?= htmlspecialchars($row['image_path']) ?></small>
                                <?php endif; ?>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
                </tbody>
              </table>

              <!-- Pagination -->
              <nav class="mt-3">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1"><i class="bx bx-chevrons-left"></i></a>
                  </li>
                  <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= max(1, $currentPage - 1) ?>"><i class="bx bx-chevron-left"></i></a>
                  </li>
                  <?php for ($i = 1; $i <= $nrPages; $i++): ?>
                    <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor; ?>
                  <li class="page-item <?= ($currentPage == $nrPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= min($nrPages, $currentPage + 1) ?>"><i class="bx bx-chevron-right"></i></a>
                  </li>
                  <li class="page-item <?= ($currentPage == $nrPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $nrPages ?>"><i class="bx bx-chevrons-right"></i></a>
                  </li>
                </ul>
              </nav>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>   
</div>

<script>
document.getElementById('searchBar').addEventListener("keyup", () => {
  const filter = document.getElementById("searchBar").value.toLowerCase();
  const rows = document.querySelectorAll("table tbody tr");
  rows.forEach(row => {
    row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
  });
});
</script>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>

<?php $conn->close(); ?>
