<?php
session_start();
require('../utilities/config.php');

// Add new genre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['genreName']) && empty($_POST['edit_id'])) {
    $genreName = mysqli_real_escape_string($conn, $_POST['genreName']);
    $query = "INSERT INTO genres (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $genreName);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    header("Location: genreManagement.php");
    exit();
}

// Edit genre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['edit_id']) && !empty($_POST['genreName'])) {
    $id = $_POST['edit_id'];
    $newName = mysqli_real_escape_string($conn, $_POST['genreName']);
    $query = "UPDATE genres SET name = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $newName, $id);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    header("Location: genreManagement.php");
    exit();
}

// Delete genre
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM genres WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    header("Location: genreManagement.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Genre Management | BookNoW Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS -->
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
    <?php include('../utilities/menu.php'); ?>

    <div class="layout-page">
      <div class="content-wrapper">
        <?php include('../utilities/navbar.php'); ?>
        <div class="container-xxl flex-grow-1 container-p-y">

          <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Book Management /</span> Genre Management
          </h4>

          <!-- Add Genre Form -->
          <div class="card mb-4">
            <h5 class="card-header">Add New Genre</h5>
            <div class="card-body">
              <!-- Error Message (Initially Hidden) -->
              <div id="error-message" class="alert alert-danger" style="display: none;">
                Please fill in the Genre Name field.
              </div>

              <form id="genreForm" action="genreManagement.php" method="POST">
                <div class="mb-3">
                  <label for="genreName" class="form-label">Genre Name</label>
                  <input type="text" class="form-control" id="genreName" name="genreName" placeholder="Enter genre name" required />
                </div>
                <button type="submit" class="btn btn-primary">
                  <i class="bx bx-book-add"></i> Add New Genre
                </button>
              </form>
            </div>
          </div>

          <!-- Genre List Table -->
          <div class="card">
            <h5 class="card-header">Genre List</h5>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Genre Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $genresPerPage = 5;
                      $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                      $offset = ($page - 1) * $genresPerPage;

                      $totalGenreQuery = "SELECT COUNT(*) AS total FROM genres";
                      $totalGenreResult = $conn->query($totalGenreQuery);
                      $totalGenreRow = $totalGenreResult->fetch_assoc();
                      $totalGenre = $totalGenreRow['total'];
                      $totalPages = ceil($totalGenre / $genresPerPage);
                      $query = "SELECT * FROM genres LIMIT $genresPerPage OFFSET $offset";
                      $result = $conn->query($query);
                   
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <tr>
                          <td>{$row['id']}</td>
                          <td>{$row['name']}</td>
                          <td>
                                <!-- Edit Button -->
                              <button type='button' class='btn rounded-pill btn-icon btn-outline-primary me-1' data-bs-toggle='modal'data-bs-target='#editGenreModal{$row['id']}' title='Edit'>
                                <i class='bx bx-pencil'></i>
                              </button>
                                <!-- Delete Button -->
                                <a href='genreManagement.php?delete=" . $row['id'] . "' class='btn rounded-pill btn-icon btn-outline-danger' title='Delete' onclick=\"return confirm('Are you sure you want to delete this genre?');\">
                                  <i class='bx bx-trash'></i>
                                </a>
                              </td>
                        </tr>

                        <!-- Edit Genre Modal -->
                        <div class='modal fade' id='editGenreModal{$row['id']}' tabindex='-1' aria-labelledby='editGenreModalLabel{$row['id']}' aria-hidden='true'>
                          <div class='modal-dialog'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='editGenreModalLabel{$row['id']}'>Edit Genre</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <form action='genreManagement.php' method='POST'>
                                  <input type='hidden' name='edit_id' value='{$row['id']}' />
                                  <div class='mb-3'>
                                    <label for='genreName{$row['id']}' class='form-label'>Genre Name</label>
                                    <input type='text' class='form-control' id='genreName{$row['id']}' name='genreName' value='" . htmlspecialchars($row['name']) . "' required />
                                  </div>
                                  <button type='submit' class='btn btn-primary'>Update Genre</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>";
                    }
                  ?>
                </tbody>
              </table>

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

  <!-- JS Scripts -->
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../assets/vendor/js/menu.js"></script>
  <script src="../assets/js/main.js"></script>
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
</body>
</html>
