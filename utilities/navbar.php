<?php
// Start session if not already started
require_once("config.php");

// Check if user is logged in and has the correct role
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || !isset($_SESSION['token'])) {
    // Redirect to guest page if session variables are missing
    header("Location: ../client/guest/mainPage.php");
    exit;
}

// Validate user session
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$token = $_SESSION['token'];

// Restrict access to userManagement.php to Admin and Librarian roles
if ($role === 'Client') {
    header("Location: ../client/guest/mainPage.php");
    exit;
}

// Fetch user details
$query = "SELECT full_name, image_path FROM users WHERE username = ? AND role = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ss", $username, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    // Invalid user or session, redirect to guest page
    header("Location: ../client/guest/mainPage.php");
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// Ensure image path is valid
$image_path = !empty($user['image_path']) && file_exists("../Uploads/users/staff/" . $user['image_path'])
    ? "../Uploads/users/staff/" . $user['image_path']
    : "../assets/img/avatars/default-user.png";
?>

<!-- Navbar -->
<style>
  #layout-navbar {
    z-index: 1055 !important;
    position: relative;
  }

  .dropdown-menu {
    z-index: 1060 !important;
  }

  .layout-container,
  .layout-wrapper,
  .content-wrapper {
    overflow: visible !important;
    position: relative;
    z-index: auto;
  }
</style>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input type="text" id="searchBar" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
      </div>
    </div>

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- User Dropdown -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown" style="z-index: 1050;">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="<?php echo htmlspecialchars($image_path); ?>" alt="User Avatar" class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1050;">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="User Avatar" class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block"><?php echo htmlspecialchars($user['full_name']); ?></span>
                  <small class="text-muted"><?php echo htmlspecialchars($role); ?></small>
                </div>
              </div>
            </a>
          </li>
          <li><div class="dropdown-divider"></div></li>
          <li><a class="dropdown-item" href="profile.php"><i class="bx bx-user me-2"></i>My Profile</a></li>
          <li><div class="dropdown-divider"></div></li>
          <li><a class="dropdown-item" href="../utilities/logOut.php?token=<?php echo htmlspecialchars($token); ?>"><i class="bx bx-power-off me-2"></i>Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<!-- /Navbar -->