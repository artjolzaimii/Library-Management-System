<?php
// filepath: c:\xampp\htdocs\Online-Library-Management-System\src\client\guest\logInSidebar.php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../../../utilities/config.php");
$error = "";

// Generate a session token if none exists
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        $query = "SELECT username, password, role FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            $error = "Server error. Please try again later.";
        } else {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['token'] = bin2hex(random_bytes(32));
                    if ($user['role'] === 'Client') {
                        header("Location: mainPage.php");
                    } else {
                        header("Location: ../../addBook.php");
                    }
                    exit();
                } else {
                    $error = "Incorrect username or password!";
                }
            } else {
                $error = "Incorrect username or password!";
            }
            $stmt->close();
        }
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
        <div class="alert alert-danger text-center mb-3"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="" id="contact-form" method="POST" autocomplete="off">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="form-clt">
                        <span>Username or email address *</span>
                        <input type="text" name="username" id="name15" class="form-control" placeholder="Enter username" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-clt">
                        <span>Password *</span>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" required>
                        <div class="icon" onclick="togglePassword()"><i class="fa-regular fa-eye"></i></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="theme-btn btn btn-primary" type="submit"><span>Log In</span></button>
                </div>
            </div>
        </form>
        <p class="text text-center">Or</p>
        <div class="user-icon-box">
            <img src="../assets/img/user.png" alt="img">
            <p>No account yet?</p>
            <a href="createAccount.php">Create an Account</a>
        </div>
    </div>
    <button id="closeButton" class="x-mark-icon"><i class="fas fa-times"></i></button>
</div>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.form-clt .icon i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
document.getElementById('closeButton').addEventListener('click', () => {
    document.getElementById('targetElement').classList.add('side_bar_hidden');
});
</script>
<?php ob_end_flush(); ?>