<?php
require('../utilities/config.php'); 

// Delete user
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: userManagement.php");
        exit;
    }
}

// Edit user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $role = $_POST['role'];

    // Prepare the update query
    $image_path = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../assets/images/users/";
        $image_name = basename($_FILES["profile_image"]["name"]);
        $target_file = $target_dir . time() . "_" . $image_name;
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    // Prepare the update query
    $update_query = "UPDATE users SET full_name=?, email=?, phone=?, username=?, role=?";
    
    if ($password) {
        $update_query .= ", password=?";
    }

    if ($image_path) {
        $update_query .= ", image=?";
    }

    $update_query .= " WHERE id=?";

    $stmt = $conn->prepare($update_query);
    
    // Binding parameters with image and password
    if ($password && $image_path) {
        $stmt->bind_param("sssssssi", $full_name, $email, $phone, $username, $role, $password, $image_path, $edit_id);
    } elseif ($password) {
        $stmt->bind_param("sssssi", $full_name, $email, $phone, $username, $role, $password, $edit_id);
    } elseif ($image_path) {
        $stmt->bind_param("ssssssi", $full_name, $email, $phone, $username, $role, $image_path, $edit_id);
    } else {
        $stmt->bind_param("sssssi", $full_name, $email, $phone, $username, $role, $edit_id);
    }

    if ($stmt->execute()) {
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
                    <div class="card-body">
                        <div class="col mb-12 d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="window.location.href='addUser.php'">
                                <i class="bx bx-book-add"></i> Add New User
                            </button>
                        </div>

                        <!-- User List Table -->
                        <div class="card mb-4">
                            <h5 class="card-header">User List</h5>
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
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                          
                                            echo "<td>" . $row['user_id'] . "</td>";
                                            echo "<td>" . $row['full_name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['role'] . "</td>";
                                            echo "<td>
                                               <!-- View Button -->
                                                <button type='button' class='btn rounded-pill btn-icon btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewUserModal{$row['id']}' title='View'>
                                                    <span class='bx bx-show'></span>
                                                </button>
                                                <!-- Edit Button -->
                                                <button type='button' class='btn rounded-pill btn-icon btn-outline-primary me-1' data-bs-toggle='modal' data-bs-target='#editUserModal{$row['id']}' title='Edit'>
                                                    <i class='bx bx-pencil'></i>
                                                </button>
                                                <!-- Delete Button -->
                                                <a href='userManagement.php?delete_id=" . $row['id'] . "' class='btn rounded-pill btn-icon btn-outline-danger' title='Delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";

                                            // Edit User Modal
                                            echo "
                                               <div class='modal fade' id='editUserModal{$row['id']}' tabindex='-1' aria-labelledby='editUserModalLabel{$row['id']}' aria-hidden='true'>
                                              <div class='modal-dialog'>
                                                  <div class='modal-content'>
                                                      <div class='modal-header'>
                                                          <h5 class='modal-title' id='editUserModalLabel{$row['id']}'>Edit User</h5>
                                                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                      </div>
                                                      <div class='modal-body'>
                                                          <form action='userManagement.php' method='POST'>
                                                             
                                                               <!-- User ID -->
                                                              <div class='mb-3'>
                                                                  <label for='full_name' class='form-label'>User ID</label>
                                                                  <input type='text' class='form-control' id='full_name' name='full_name' value='" . $row['user_id'] . "' required />
                                                              </div>
                                                              <!-- Full Name -->
                                                              <div class='mb-3'>
                                                                  <label for='full_name' class='form-label'>Full Name</label>
                                                                  <input type='text' class='form-control' id='full_name' name='full_name' value='" . $row['full_name'] . "' required />
                                                              </div>
                                                               <!-- Profile Image Display -->
                                                                  <div class='mb-3'>
                                                                      <label for='profile_image' class='form-label'>Profile Image</label><br>
                                                                      <img src='" . $row['image'] . "' alt='Profile Image' style='height: 50px; border-radius: 50%;'>
                                                                      <input type='file' class='form-control mt-2' name='profile_image' accept='image/*' />
                                                                  </div>

                                                              <!-- Email -->
                                                              <div class='mb-3'>
                                                                  <label for='email' class='form-label'>Email</label>
                                                                  <input type='email' class='form-control' id='email' name='email' value='" . $row['email'] . "' required />
                                                              </div>

                                                              <!-- Phone -->
                                                              <div class='mb-3'>
                                                                  <label for='phone' class='form-label'>Phone</label>
                                                                  <input type='text' class='form-control' id='phone' name='phone' value='" . $row['phone'] . "' required />
                                                              </div>

                                                              <!-- Username -->
                                                              <div class='mb-3'>
                                                                  <label for='username' class='form-label'>Username</label>
                                                                  <input type='text' class='form-control' id='username' name='username' value='" . $row['username'] . "' required />
                                                              </div>

                                                              <!-- Password (Leave Blank to Keep Current) -->
                                                              <div class='mb-3'>
                                                                  <label for='password' class='form-label'>Password (Leave blank to keep current)</label>
                                                                  <input type='password' class='form-control' id='password' name='password' placeholder='Enter new password (leave empty to keep current)' />
                                                              </div>

                                                              <!-- Role -->
                                                              <div class='mb-3'>
                                                                  <label for='role' class='form-label'>Role</label>
                                                                  <select class='form-select' id='role' name='role' required>
                                                                      <option value='Librarian' " . ($row['role'] == 'Librarian' ? 'selected' : '') . ">Librarian</option>
                                                                      <option value='Admin' " . ($row['role'] == 'Admin' ? 'selected' : '') . ">Admin</option>
                                                                      <option value='User' " . ($row['role'] == 'User' ? 'selected' : '') . ">User</option>
                                                                  </select>
                                                              </div>

                                                              <!-- Gender -->
                                                              <div class='mb-3'>
                                                                  <label for='gender' class='form-label'>Gender</label>
                                                                  <select class='form-select' id='gender' name='gender' required>
                                                                      <option value='Male' " . ($row['gender'] == 'Male' ? 'selected' : '') . ">Male</option>
                                                                      <option value='Female' " . ($row['gender'] == 'Female' ? 'selected' : '') . ">Female</option>
                                                                      <option value='Other' " . ($row['gender'] == 'Other' ? 'selected' : '') . ">Other</option>
                                                                  </select>
                                                              </div>

                                                              <!-- Birthday -->
                                                              <div class='mb-3'>
                                                                  <label for='birthday' class='form-label'>Birthday</label>
                                                                  <input type='date' class='form-control' id='birthday' name='birthday' value='" . $row['birthday'] . "' required />
                                                              </div>


                                                              <button type='submit' class='btn btn-primary'>Update User</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                            ";

                                             // View User Modal
                                             echo "
                                             <div class='modal fade' id='viewUserModal{$row['id']}' tabindex='-1' aria-labelledby='viewUserModalLabel{$row['id']}' aria-hidden='true'>
                                                 <div class='modal-dialog'>
                                                     <div class='modal-content'>
                                                         <div class='modal-header'>
                                                             <h5 class='modal-title' id='viewUserModalLabel{$row['id']}'>View User</h5>
                                                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                         </div>
                                                         <div class='modal-body'>
                                                          <p><strong>User ID:</strong> " . $row['user_id'] . "</p>
                                                             <p><strong>Full Name:</strong> " . $row['full_name'] . "</p>
                                                             <p><strong>Email:</strong> " . $row['email'] . "</p>
                                                             <p><strong>Phone:</strong> " . $row['phone'] . "</p>
                                                             <p><strong>Username:</strong> " . $row['username'] . "</p>
                                                             <p><strong>Role:</strong> " . $row['role'] . "</p>
                                                             <p><strong>Gender:</strong> " . $row['gender'] . "</p>
                                                             <p><strong>Birthday:</strong> " . $row['birthday'] . "</p>
                                                              <p><strong>Image:</strong> " . $row['image'] . "</p>
                                                            
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>";
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
    </div>
    <script>
  document.getElementById('searchBar').addEventListener("keyup", () => {
    filterTables();
  });

  function filterTables() {
    const filter = document.getElementById("searchBar").value.toLowerCase();
    const allTables = document.querySelectorAll("table");

    allTables.forEach(table => {
      const rows = table.querySelectorAll("tbody tr");
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  }
  
  
</script>
  
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
