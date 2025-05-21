<?php
require('../utilities/config.php');

$book_id = $_POST['book_id'] ?? null;
$borrow_date = $_POST['borrow_date'] ?? null;
$return_date = $_POST['return_date'] ?? null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Book | BookNoW Admin</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico">

    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
</head>
<body>
     <?php include('../utilities/menu.php'); ?>

    <div class="layout-page">
      <div class="content-wrapper">
        <?php include('../utilities/navbar.php'); ?>
        <div class="container mt-5" style="max-width: 600px;">
            <h3 class="mb-4">Borrow a Book</h3>
            <form method="POST" action="borrowingBooksBack.php">
                <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">
                <input type="hidden" name="borrow_date" value="<?php echo htmlspecialchars($borrow_date); ?>">  
                <input type="hidden" name="return_date" value="<?php echo htmlspecialchars($return_date); ?>">
                
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" required>   
                </div> 
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" required>   
                </div> 
                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" required>   
                </div> 
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>   
                </div> 
                <button type="submit" class="btn btn-primary">Borrow</button>
            </form>
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
