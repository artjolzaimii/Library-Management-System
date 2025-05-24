<?php 
  require_once("config.php");
  
  if(!isset($_SESSION['username']) || !isset($_SESSION['role']) || !isset($_SESSION['token'])){
    if($_SESSION['role']=='Client'){
      echo "<script>window.location.href='/Online-Library-Management-System/src/client/guest/mainPage.php'</script>";
    }
  }
  else{
    $username=mysqli_real_escape_string($conn,$_SESSION['username']);
    $role=mysqli_real_escape_string($conn,$_SESSION['role']);
    $token=mysqli_real_escape_string($conn,$_SESSION['token']);
    
    $query="SELECT full_name, image_path
            FROM users
            WHERE username=?";
          
    $stm=$conn->prepare($query);
    $stm->bind_param("s",$username);
    $stm->execute();
    
    $result=$stm->get_result();
    
    if($result->num_rows!=1){
      echo "<script>window.location.href='../client/guest/mainPage.php'</script>";
    }
    $user=$result->fetch_assoc();
  }

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
            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1050;">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="../uploads/users/staff/<?php echo $user['image_path']?>" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block"><?php echo $user['full_name']?></span>
                  <small class="text-muted"><?php echo $role?></small>
                </div>
              </div>
            </a>
          </li>
          <li><div class="dropdown-divider" ></div></li>
          <li><a class="dropdown-item" href="#"><i class="bx bx-user me-2"></i>My Profile</a></li>
          <li><div class="dropdown-divider"></div></li>
          <li><a class="dropdown-item" href="../utilities/logOut.php?token=<?php echo $token?>"><i class="bx bx-power-off me-2"></i>Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div>
  
</nav>
<!-- /Navbar -->
