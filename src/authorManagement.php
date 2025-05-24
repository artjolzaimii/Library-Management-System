<?php
ob_start(); // Start output buffering
session_start();
?>

<?php
require_once('../utilities/config.php');

$query = "SELECT * FROM author";
$result = $conn->query($query); 

if (!$result) {
    die("Database query failed: " . $conn->error);
}

//Update author functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author_id = $_POST['author_id'];
    $full_name = $_POST['full_name'];
    $bio = $_POST['bio'];
    $nationality = $_POST['nationality'];
    $birth_year = $_POST['birth_year'];
    $death_year = $_POST['death_year'];

    $targetDir = "../uploads/authors";
    if(!file_exists($targetDir)){
        mkdir($targetDir, 0777, true);
    }

    $imagePath = null;
    if(isset($_FILES["authorImage"]) && $_FILES["authorImage"]["error"] == 0){
        $fileName = time() . '_' . basename($_FILES["authorImage"]["name"]);
        $targetPath = $targetDir . '/' . $fileName;

        if(getimagesize($_FILES["authorImage"]["tmp_name"]) !== false) {
            if(move_uploaded_file($_FILES["authorImage"]["tmp_name"], $targetPath)) {
                $imagePath = "uploads/authors/" . $fileName;
            } else {
                echo "<div class='alert alert-danger'>Failed to move uploaded file.</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>File is not an image.</div>";
            exit;
        }
    }

    $update_query = "UPDATE author 
                    SET full_name = ?, bio = ?, nationality = ?, 
                        birth_year = ?, death_year = ?";
    
    $params = array($full_name, $bio, $nationality, $birth_year, $death_year);
    $types = "sssii";
    
    if ($imagePath) {
        $update_query .= ", image_path = ?";
        $params[] = $imagePath;
        $types .= "s";
    }
    
    $update_query .= " WHERE author_id = ?";
    $params[] = $author_id;
    $types .= "i";
    
    if ($stmt = $conn->prepare($update_query)) {
        $stmt->bind_param($types, ...$params);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>
                    Author updated successfully!
                  </div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'authorManagement.php';
                    }, 2000);
                  </script>";
        } else {
            echo "<script>
                alert('Error updating author: " . $conn->error . "');
                window.location.href = 'authorManagement.php';
            </script>";
        }
        $stmt->close();
    }
}

//Delete author functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    $delete_query = "DELETE FROM author WHERE author_id = ?";
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $delete_id);
        
        if ($stmt->execute()) {
            echo "<script>
                alert('Author deleted successfully!');
                window.location.href = 'authorManagement.php';
            </script>";
        } else {
            echo "<script>
                alert('Error deleting author: " . $conn->error . "');
                window.location.href = 'authorManagement.php';
            </script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Author Management | BookNoW Admin</title>
</head>

<body>
    <div class="layout-container">
        <?php include('../utilities/menu.php'); ?>

        <div class="layout-page">
            <div class="content-wrapper">
                <?php include('../utilities/navbar.php'); ?>

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Admin /</span> Author Management
                    </h4>
                    <div class="card-body">
                        <div class="col mb-12 d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="window.location.href='addAuthor.php'">
                                <i class="bx bx-book-add"></i> Add New Author
                            </button>
                        </div>

                        <!-- Author List Table -->
                        <div class="card mb-4">
                            <h5 class="card-header">Author List</h5>
                            <div class="table-responsive text-nowrap" style="max-width: 1150px; margin: 0 auto;">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Author ID</th>
                                            <th>Full Name</th>
                                            <th>Nationality</th>
                                            <th>Birth year</th>
                                            <th>Death year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                          
                                            echo "<td>" . $row['author_id'] . "</td>";
                                            echo "<td>" . $row['full_name'] . "</td>";
                                            echo "<td>" . $row['nationality'] . "</td>";
                                            echo "<td>" . $row['birth_year'] . "</td>";
                                            echo "<td>" . (empty($row['death_year']) || $row['death_year'] == '0000' ? '-' : $row['death_year']) . "</td>";
                                            echo "<td>
                                               <!-- View Button -->
                                                <button type='button' class='btn rounded-pill btn-icon btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewAuthorModal{$row['author_id']}' title='View'>
                                                    <span class='bx bx-show'></span>
                                                </button>
                                                <!-- Edit Button -->
                                                <button type='button' class='btn rounded-pill btn-icon btn-outline-primary me-1' data-bs-toggle='modal' data-bs-target='#editAuthorModal{$row['author_id']}' title='Edit'>
                                                    <i class='bx bx-pencil'></i>
                                                </button>
                                                <!-- Delete Button -->
                                                <a href='authorManagement.php?delete_id=" . $row['author_id'] . "' class='btn rounded-pill btn-icon btn-outline-danger' title='Delete' onclick=\"return confirm('Are you sure you want to delete this author?');\">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                            </td>";
                                            echo "</tr>";

                                            // Edit Author Modal
                                            echo "
                                               <div class='modal fade' id='editAuthorModal{$row['author_id']}' tabindex='-1' aria-labelledby='editAuthorModalLabel{$row['author_id']}' aria-hidden='true'>
                                              <div class='modal-dialog'>
                                                  <div class='modal-content'>
                                                      <div class='modal-header'>
                                                          <h5 class='modal-title' id='editAuthorModalLabel{$row['author_id']}'>Edit Author</h5>
                                                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                      </div>
                                                      <div class='modal-body'>
                                                          <form action='authorManagement.php' method='POST' enctype='multipart/form-data'>
                                                             
                                                               <!-- Author ID -->
                                                              <div class='mb-3'>
                                                                  <label for='author_id' class='form-label'>Author ID</label>
                                                                  <input type='text' class='form-control' id='author_id' name='author_id' value='" . $row['author_id'] . "' required />
                                                              </div>
                                                              <!-- Full Name -->
                                                              <div class='mb-3'>
                                                                  <label for='full_name' class='form-label'>Full Name</label>
                                                                  <input type='text' class='form-control' id='full_name' name='full_name' value='" . $row['full_name'] . "' required />
                                                              </div>
                                                              <!-- Bio -->
                                                              <div class='mb-3'>
                                                                  <label for='bio' class='form-label'>Bio</label>
                                                                  <input type='text' class='form-control' id='bio' name='bio' value='" . $row['bio'] . "' required />
                                                              </div>

                                                              <!-- Nationality -->
                                                              <div class='mb-3'>
                                                                  <label for='nationality' class='form-label'>Nationality</label>
                                                                  <input type='text' class='form-control' id='nationality' name='nationality' value='" . $row['nationality'] . "' required />
                                                              </div>

                                                              <!-- Birth year -->
                                                              <div class='mb-3'>
                                                                  <label for='birth_year' class='form-label'>Birth Year</label>
                                                                  <input type='text' class='form-control' id='birth_year' name='birth_year' value='" . $row['birth_year'] . "' required />
                                                              </div>

                                                              <!-- Death year -->
                                                              <div class='mb-3'>
                                                                  <label for='death_year' class='form-label'>Death Year</label>
                                                                  <input type='text' class='form-control' id='death_year' name='death_year' value='" . $row['death_year'] . "' />
                                                              </div>
                                                              
                                                              <!-- Author Image -->
                                                              <div class='mb-3'>
                                                                  <label for='authorImage' class='form-label'>Author Image</label>
                                                                  <div class='input-group'>
                                                                      <span class='input-group-text'><i class='bx bx-image'></i></span>
                                                                      <input type='file' class='form-control' name='authorImage' id='authorImage' accept='image/*'>
                                                                  </div>
                                                                  " . ($row['image_path'] ? "<small class='text-muted'>Current image: " . $row['image_path'] . "</small>" : "") . "
                                                              </div>
                                                              
                                                              <button type='submit' class='btn btn-primary'>Update Author</button>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                            ";

                                             // View User Modal
                                             echo "
                                             <div class='modal fade' id='viewAuthorModal{$row['author_id']}' tabindex='-1' aria-labelledby='viewAuthorModalLabel{$row['author_id']}' aria-hidden='true'>
                                                 <div class='modal-dialog'>
                                                     <div class='modal-content'>
                                                         <div class='modal-header'>
                                                             <h5 class='modal-title' id='viewAuthorModalLabel{$row['author_id']}'>View Author</h5>
                                                             <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                         </div>
                                                         <div class='modal-body'>
                                                          <p><strong>Author ID:</strong> " . $row['author_id'] . "</p>
                                                             <p><strong>Full Name:</strong> " . $row['full_name'] . "</p>
                                                             <p><strong>Bio:</strong> " . $row['bio'] . "</p>
                                                             <p><strong>Nationality:</strong> " . $row['nationality'] . "</p>
                                                             <p><strong>Birth year:</strong> " . $row['birth_year'] . "</p>
                                                             <p><strong>Death year:</strong> " . ($row['death_year'] == 0000 ? '-' : $row['death_year']). "</p>
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
</html><?php ob_flush()?>