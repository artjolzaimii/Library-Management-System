<?php 
    session_start();
    require_once("../utilities/config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $conn->real_escape_string(trim($_POST['full_name']));
        $nationality = $conn->real_escape_string(trim($_POST['nationality']));
        $birthYear = intval($_POST['birth_year']);
        $deathYear = !empty($_POST['death_year']) ? intval($_POST['death_year']) : null;
        $bio = $conn->real_escape_string(trim($_POST['bio']));

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
                  die("<div class='alert alert-danger'>Failed to move uploaded file.</div>");
              }
          } else {
              die("<div class='alert alert-danger'>File is not an image.</div>");
          }
        }

          //Prepare to insert in database
          $sql = "INSERT INTO author (full_name, bio, nationality, birth_year, death_year, image_path) 
                  VALUES (?, ?, ?, ?, ?, ?)";
          
        if($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("sssiis", $name, $bio, $nationality, $birthYear, $deathYear, $imagePath);
          
            if($stmt->execute()) {
              echo "<div class='alert alert-success'>Author added successfully!</div>";
              echo "<script>
              setTimeout(function() {
                window.location.href = 'authorManagement.php';
              }, 2000);
              </script>";
          } else {
              echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
          }
          $stmt->close();
      } else {
          echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
      }
      $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Author</title>
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
                  <input type="number" class="form-control" name="birth_year" id="birth_year" placeholder="Ex: 1936" min="1000" max="2025" required>
                </div>
              </div>
              <div class="col-md-4">
                <label for="death_year" class="form-label">Death Year</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                  <input type="number" class="form-control" name="death_year" id="death_year" placeholder="Ex: 2024" min="1500" max="2025">
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="bio" class="form-label">Biography</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-detail"></i></span>
                  <textarea class="form-control" name="bio" id="bio" placeholder="Ex: Born on the 28th of January 1936..." rows="2" maxlength="5000" required></textarea>
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
              <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save Author</button>
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