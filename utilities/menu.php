<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <title>BookNoW Admin Panel</title>

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

  <!-- JS Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <!-- Sidebar Menu -->
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.php" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">BookNoW</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item">
        <a href="index.php" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Home</div>
        </a>
      </li>

      <!-- Management Header -->
      <li class="menu-header small text-uppercase"><span>Management</span></li>

      <!-- User Management -->
      <li class="menu-item">
        <a href="user_management.php" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div>User Management</div>
        </a>
      </li>

      <!-- Book Management -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-book"></i>
          <div>Book Management</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="author_management.php" class="menu-link">
              <div>Author Management</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="genre_management.php" class="menu-link">
              <div>Genre Management</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="add_book.php" class="menu-link">
              <div>Add Book</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="edit_delete_book.php" class="menu-link">
              <div>Edit/Delete</div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>
</body>
</html>
