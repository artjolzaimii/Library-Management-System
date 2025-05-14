<?php
require('../utilities/config.php'); 

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM users WHERE id = $delete_id";
    if ($conn->query($delete_query) === TRUE) {
        header("Location: userManagement.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = $_POST['role'];

    $update_query = "UPDATE users SET full_name='$full_name', email='$email', phone='$phone', username='$username', password='$password', role='$role' WHERE id=$edit_id";
    if ($conn->query($update_query) === TRUE) {
        header("Location: userManagement.php");
        exit;
    }
}

$query = "SELECT * FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Management | BookNoW Admin</title>
  <!-- Include your stylesheets here -->
</head>

<body>
  <div class="layout-container">
    <!-- Include the menu and navbar -->
    <?php include('../utilities/menu.php'); ?>

    <div class="layout-page">
      <div class="content-wrapper">
        <?php include('../utilities/navbar.php'); ?>

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin /</span> User Management
          </h4>

          <!-- User List Table -->
          <div class="card mb-4">
            <h5 class="card-header">User List</h5>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>                   
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['full_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                   // echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>
                            <a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Edit</a>
                            <a href='userManagement.php?delete_id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                          </td>";
                    echo "</tr>";

                    echo "
                    <div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='editModalLabel'>Edit User</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <form action='userManagement.php' method='POST'>
                                        <input type='hidden' name='edit_id' value='" . $row['id'] . "' />
                                        <div class='mb-3'>
                                            <label for='full_name' class='form-label'>Full Name</label>
                                            <input type='text' class='form-control' id='full_name' name='full_name' value='" . $row['full_name'] . "' required />
                                        </div>
                                        <div class='mb-3'>
                                            <label for='email' class='form-label'>Email</label>
                                            <input type='email' class='form-control' id='email' name='email' value='" . $row['email'] . "' required />
                                        </div>
                                        <div class='mb-3'>
                                            <label for='phone' class='form-label'>Phone</label>
                                            <input type='text' class='form-control' id='phone' name='phone' value='" . $row['phone'] . "' required />
                                        </div>
                                        <div class='mb-3'>
                                            <label for='username' class='form-label'>Username</label>
                                            <input type='text' class='form-control' id='username' name='username' value='" . $row['username'] . "' required />
                                        </div>
                                        ";
                                        //Not necessary to edit role
                                        echo"
                                        <div class='mb-3'>
                                            <label for='role' class='form-label'>Role</label>
                                            <select class='form-select' id='role' name='role' required>
                                                <option value='Librarian' " . ($row['role'] == 'librarian' ? 'selected' : '') . ">Library Manager</option>
                                                <option value='User' " . ($row['role'] == 'User' ? 'selected' : '') . ">User</option>
                                            </select>
                                        </div>
                                        <button type='submit' class='btn btn-primary'>Update User</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../assets/vendor/js/menu.js"></script>
  <script src="../assets/js/main.js"></script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
