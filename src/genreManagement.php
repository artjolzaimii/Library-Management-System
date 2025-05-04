<?php
require('../utilities/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genreName'])) {
    $genreName = mysqli_real_escape_string($conn, $_POST['genreName']);
    $query = "INSERT INTO genres (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $genreName);

    if (mysqli_stmt_execute($stmt)) {
        echo "Genre added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM genres WHERE id = $id");
    $genre = mysqli_fetch_assoc($result);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genreName'])) {
        $newName = mysqli_real_escape_string($conn, $_POST['genreName']);
        $query = "UPDATE genres SET name = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'si', $newName, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Genre updated successfully.";
            header("Location: genreManagement.php"); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM genres WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Genre deleted successfully.";
        header("Location: genreManagement.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
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

          <!-- Add Genre Form -->
          <div class="card mb-4">
            <h5 class="card-header">Add New Genre</h5>
            <div class="card-body">
              <form action="genreManagement.php" method="POST">
                <div class="mb-3">
                  <label for="genreName" class="form-label">Genre Name</label>
                  <input type="text" class="form-control" id="genreName" name="genreName" placeholder="Enter genre name" required />
                </div>
                <button type="submit" class="btn btn-primary">Add Genre</button>
              </form>
            </div>
          </div>
          <?php if (isset($_GET['edit'])): ?>
            <div class="card mb-4">
                <h5 class="card-header">Edit Genre</h5>
                <div class="card-body">
                    <form action="genreManagement.php?edit=<?php echo $_GET['edit']; ?>" method="POST">
                        <div class="mb-3">
                            <label for="genreName" class="form-label">Genre Name</label>
                            <input type="text" class="form-control" id="genreName" name="genreName" value="<?php echo htmlspecialchars($genre['name']); ?>" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Update Genre</button>
                    </form>
                </div>
            </div>
          <?php endif; ?>

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
                   
                    $result = mysqli_query($conn, "SELECT * FROM genres");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>
                                  <a href='genreManagement.php?edit=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                  <a href='genreManagement.php?delete=" . $row['id'] . "' class='btn btn-sm btn-danger'>Delete</a>
                                </td>
                              </tr>";
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
  <script src="../assets/js/extended-ui-perfect-scrollbar.js"></script>
</body>
</html>
