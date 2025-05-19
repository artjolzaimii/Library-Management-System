<?php 
    require_once("../../../utilities/config.php");
    
function clean_input($conn, $key) {
    return isset($_POST[$key]) ? mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST[$key]))) : '';
}

$firstName = clean_input($conn, 'firstName');
$lastName  = clean_input($conn, 'lastName');
$country   = clean_input($conn, 'country');
$address   = clean_input($conn, 'address');
$city      = clean_input($conn, 'city');
$phone     = clean_input($conn, 'phone');
$email     = clean_input($conn, 'email');
$notes     = clean_input($conn, 'notes');


$errors = [];

if (empty($firstName)) $errors[] = "First name is required.";
if (empty($lastName))  $errors[] = "Last name is required.";
if (empty($country))   $errors[] = "Country is required.";
if (empty($address))   $errors[] = "Address is required.";
if (empty($city))      $errors[] = "City is required.";
if (empty($phone))     $errors[] = "Phone is required.";
if (empty($email))     $errors[] = "Email is required.";


if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (!empty($phone) && !preg_match('/^[0-9\-\+\s\(\)]+$/', $phone)) {
    $errors[] = "Invalid phone number format.";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}

$query=
"
    INSERT INTO orders
";
?>