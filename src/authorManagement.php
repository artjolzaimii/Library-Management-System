<?php 
    require_once("../utilities/config1.php");
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
          <span class="text-muted fw-light">Author Management /</span> Add Author
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-book-add"></i> Add Author</h5>
          <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="full_name" class="form-label">Name Surname</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Ex: Ismail Kadare">
                </div>
              </div>
            </div>
          
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="nationality" class="form-label">Nationality</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-flag"></i></span>
                  <input type="text" class="form-control" name="nationality" id="nationality" placeholder="ex: Albania" required>
                </div>
              </div>
              <div class="col-md-4">
                <label for="birth_year" class="form-label">Birth Year</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-cake"></i></span>
                  <input type="number" class="form-control" name="birth_year" id="birth_year" placeholder="Ex: 1936" max="2025" required>
                </div>
              </div>
              <div class="col-md-4">
                <label for="death_year" class="form-label">Death Year</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                  <input type="number" class="form-control" name="death_year" id="death_year" placeholder="Ex: 2024" min="1900" max="2025">
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="bio" class="form-label">Biography</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-detail"></i></span>
                  <textarea class="form-control" name="bio" id="bio" placeholder="Ex: Lindur në 28 Janar 1936..." rows="2" maxlength="50" required></textarea>
                </div>
              </div>
            </div>
          
            <div class="row mb-4">
              <div class="col-md-12">
                <label for="authorImage" class="form-label">Author Image</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-image"></i></span>
                  <input type="file" class="form-control" name="authorImage" id="authorImage" accept = "image/*">
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
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['full_name'];
    $nationality = $_POST['nationality'];
    $birthYear = $_POST['birth_year'];
    $deathYear = $_POST['death_year'];
    $bio = $_POST['bio'];

    try {
      $sql = "INSERT INTO authors (full_name, bio, nationality, birth_year, death_year) 
              VALUES (:name, :bio, :nationality, :birthYear, :deathYear)";
      
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':bio', $bio);
      $stmt->bindParam(':nationality', $nationality);
      $stmt->bindParam(':birthYear', $birthYear);
      $stmt->bindParam(':deathYear', $deathYear);
      
      $stmt->execute();
      
      echo "<div class='alert alert-success'>Author added successfully!</div>";
  } catch(PDOException $e) {
      echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
  }
}
?>
</body>
</html>