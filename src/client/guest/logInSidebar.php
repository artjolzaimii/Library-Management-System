<?php
require_once(__DIR__."/../../../utilities/config.php");
$error = "";

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stm = $conn->prepare($query);
    $stm->bind_param("s", $username);
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['token'] = bin2hex(random_bytes(32));
            
            if($user['role']=='Client'){
                header("Location: mainPage.php");
            }
            else{
                header("Location: ../../addBook.php");
            }
            
            exit();
        } else {
            $error = "Incorrect username or password!";
        }
    } else {
        $error = "Incorrect username or password!";
    }
}


?>
<div id="targetElement" class="side_bar slideInRight side_bar_hidden">
    <div class="side_bar_overlay"></div>
    <div class="cart-title mb-50">
        <h4>Log in</h4>
    </div>
    <div class="login-sidebar">
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center mb-3"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" id="contact-form" method="POST">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="form-clt">
                        <span>Username or email address *</span>
                        <input type="text" name="username" id="name15" placeholder="" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-clt">
                        <span>Password *</span>
                        <input id="password" type="password" placeholder="" name="password" required>
                        <div class="icon"><i class="fa-regular fa-eye"></i></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="theme-btn" type="submit"><span>Log In</span></button>
                </div>
            </div>
        </form>
        <p class="text">Or</p>
        <div class="user-icon-box">
            <img src="../assets/img/user.png" alt="img">
            <p>No account yet?</p>
            <a href="createAccount.php">Create an Account</a>
        </div>
    </div>
    <button id="closeButton" class="x-mark-icon"><i class="fas fa-times"></i></button>
</div>
<?php ob_end_flush(); // Flush output at the end ?>