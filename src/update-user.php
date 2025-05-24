<?php
require_once("../utilities/config.php");
session_start();

if (!isset($_POST['edit_id'])) {
    die("User ID not provided.");
}

$user_id = intval($_POST['edit_id']);

function clean($conn, $str) {
    return mysqli_real_escape_string($conn, trim($str));
}

// Clean input fields
$custom_id = clean($conn, $_POST['user_id']);
$full_name = clean($conn, $_POST['full_name']);
$email = clean($conn, $_POST['email']);
$phone = clean($conn, $_POST['phone']);
$address = clean($conn, $_POST['address']);
$username = clean($conn, $_POST['username']);
$role = clean($conn, $_POST['role']);
$gender = clean($conn, $_POST['gender']);
$birthday = clean($conn, $_POST['birthday']);

// Handle password (only if new password is provided)
$password = isset($_POST['password']) && trim($_POST['password']) !== '' ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

// Handle image upload
$image_path = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $imgTmp = $_FILES['profile_image']['tmp_name'];
    $imgName = uniqid() . "_" . basename($_FILES['profile_image']['name']);
    move_uploaded_file($imgTmp, "../uploads/images/" . $imgName);
    $image_path = $imgName;
}

// Build the update query dynamically
$update_query = "UPDATE users SET user_id=?, full_name=?, email=?, phone=?, address=?, username=?, role=?, gender=?, birthday=?";
$params = [$custom_id, $full_name, $email, $phone, $address, $username, $role, $gender, $birthday];
$types = "sssssssss";

if ($password) {
    $update_query .= ", password=?";
    $params[] = $password;
    $types .= "s";
}
if ($image_path) {
    $update_query .= ", image_path=?";
    $params[] = $image_path;
    $types .= "s";
}

$update_query .= " WHERE id=?";
$params[] = $user_id;
$types .= "i";

// Prepare and execute the update
$stmt = $conn->prepare($update_query);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param($types, ...$params);
if (!$stmt->execute()) {
    die("Error updating user: " . $stmt->error);
}
$stmt->close();

header("Location: userManagement.php");
exit();
?>
