<?php
require('../utilities/config.php');

$books = mysqli_query($conn, "SELECT * FROM book");
$users = mysqli_query($conn, "SELECT * FROM users WHERE role = 'user'");

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
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="book_id" class="form-label">Select Book</label>
                    <select name="book_id" id="book_id" class="form-select" required>
                        <option value="">-- Choose a Book --</option>
                        <?php while ($book = mysqli_fetch_assoc($books)): ?>
                            <option value="<?= $book['book_id'] ?>"><?= ($book['title']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" required>   
                </div>
                <div class="mb-3">
                    <label for="borrow_date" class="form-label">Borrow Date</label>
                    <input type="date" name="borrow_date" id="borrow_date" class="form-control" required>   
                </div>
                <div class="mb-3">
                    <label for="return_date" class="form-label">Return Date</label>
                    <input type="date" name="return_date" id="return_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Condition</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">-- Choose Condition --</option>
                        <option value="borrowed">Very Good</option>
                        <option value="returned">Good</option>
                        <option value="returned">Fair</option>
                    </select>
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
