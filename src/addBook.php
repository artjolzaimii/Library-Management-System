<?php 
    require_once("../utilities/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Book</title>
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
          <span class="text-muted fw-light">Book Management /</span> Add Book
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-book-add"></i> Add Book</h5>
          <div class="card-body">
            <form action="addBook-backend.php" method="POST">
              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                    <input type="text" class="form-control" name="isbn" placeholder="ISBN">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <select name="authors[]" id="authors" class="form-control" multiple>
                      <option value="" disabled>Select author(s)...</option>
                      <?php 
                        /*
                        $query = 'SELECT author_id, name FROM `author`';
                        $stm = $mysqli->prepare($query);
                        if ($stm) {
                          $stm->execute();
                          $stm->bind_result($author_id, $author_name);
                          while ($stm->fetch()) {
                              echo "<option value=".htmlspecialchars($author_id).">".htmlspecialchars($author_name)."</option>";
                          }
                        }
                        */
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-category"></i></span>
                    <select name="genres[]" id="genres" class="form-control" multiple>
                      <option value="" disabled>Select genres...</option>
                      <?php 
                        /*
                        $query = "SELECT name FROM `genres`";
                        $stm = $mysqli->prepare($query);
                        if ($stm) {
                          $stm->execute();
                          $stm->bind_result($genre);
                          while ($stm->fetch()) {
                              echo "<option value=".htmlspecialchars($genre).">".htmlspecialchars($genre)."</option>";
                          }
                        }
                        */
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-file"></i></span>
                    <input type="number" class="form-control" name="nrPages" placeholder="Number of pages">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                    <input type="text" class="form-control" name="publisher" placeholder="Publisher">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="number" class="form-control" name="publication_year" placeholder="Publication Year">
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-world"></i></span>
                    <input type="text" class="form-control" name="language" placeholder="Language">
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-detail"></i></span>
                    <textarea class="form-control" name="description" placeholder="Description" rows="3"></textarea>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-dollar"></i></span>
                    <input type="text" class="form-control" name="price" placeholder="Price">
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-box"></i></span>
                    <input type="number" class="form-control" name="inventory" placeholder="Inventory" min="0">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-layer"></i></span>
                    <input type="text" class="form-control" name="format" placeholder="Format">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-check-circle"></i></span>
                    <input type="text" class="form-control" name="condition" placeholder="Condition">
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-image"></i></span>
                    <input type="file" class="form-control" name="imagePath">
                  </div>
                </div>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save Book</button>
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
