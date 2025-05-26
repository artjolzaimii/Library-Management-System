<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

  require_once("config.php");
  
  if(!isset($_SESSION['username'])){
    header("Location: Client/guest/mainPage.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>Eternal Library Admin Panel</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

</head>

<body>
  <!-- Sidebar Menu -->
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="adminDashboard.php" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Eternal Library</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item">
        <a href="adminDashboard.php" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Dashboard</div>
        </a>
      </li>

      <!-- Management Header -->
      <li class="menu-header small text-uppercase"><span>Content Management</span></li>

      <!-- User Management -->
      <?php if($_SESSION['role']=='Admin'):?>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div>Users</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="addUser.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user-plus"></i>
              <div>Add New User</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="userManagement.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div>User Management</div>
            </a>
          </li>
        </ul>
      </li>
      <?php endif;?>
      <!-- Author Management -->
            <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div>Authors</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="addAuthor.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user-plus"></i>
              <div>Add New Author</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="authorManagement.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div>Author Management</div>
            </a>
          </li>
        </ul>
      </li>  
      
      <!-- Book Management -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-book"></i>
          <div>Books</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="genreManagement.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-category"></i>
              <div>Genre Mangement</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="addBook.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book-add"></i>
              <div>Add Book</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="bookManagement.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-library"></i>
              <div>Book Management</div>
            </a>
          </li>
        </ul>
      </li>
       <!-- Borrowed Books -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
	      <i class="menu-icon tf-icons bx bx-book-reader"></i>

          <div>Borrowed Books</div>
        </a>
        <ul class="menu-sub">
                    <li class="menu-item">
            <a href="borrow_book.php" class="menu-link">
              <div>Borrow a Book</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="trackBorrowedBooks.php" class="menu-link">
              <div>Track Borrowed Books</div>
            </a>
          </li>
        </ul>
      </li>
      <!-- Stock Management -->
      <li class="menu-item">
        <a href="stockManagement.php" class="menu-link">
          <i class="menu-icon tf-icons bx bx-store"></i>
          <div>Stock Management</div>
        </a>
      </li>
      
       <!-- Orders Management -->
      <li class="menu-item">
        <a href="orders.php" class="menu-link">
          <i class="menu-icon tf-icons bx bx-receipt"></i>
          <div>Orders Management</div>
        </a>
      </li>
      
      <!-- Report Management -->
      <?php if($_SESSION['role']=='Admin'):?>
      <li class="menu-item"> 
        <a href="generateReport.php" class="menu-link">
          <i class="menu-icon tf-icons bx  bx-chart-bar-rows"></i>
          <div>Report Management</div>
        </a>
      </li>
    </ul>
    <?php endif;?>
  </aside>
  
  <!-- JS Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script> 

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>
</body>
</html>
