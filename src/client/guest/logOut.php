<?php 
    session_start();
    if(isset($_GET['token'])){
      $token=$_GET['token'];  
    }
    else{
        echo "<script>window.location.href='mainPage.php'</script>";
    }

    if(isset($_SESSION['username']) && isset($_SESSION['role']) && isset($_SESSION['token'])){
        if($_SESSION['token']==$token){
            unset($_SESSION['username']);
            unset($_SESSION['role']);
            unset($_SESSION['token']);
            
            session_destroy();
            echo "<script>window.location.href='mainPage.php'</script>";
        }
        else{
            echo "<script>window.location.href='mainPage.php'</script>";

        }
    }
    else{
        echo "<script>window.location.href='mainPage.php'</script>";
    }
?>