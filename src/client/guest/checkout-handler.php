<?php
    require_once("clientMenu.php");
    require_once("../../../utilities/config1.php");
    require_once("./ShoppingCart/shoppingCartFunctionalities.php");
    $cartId=getShopCartId($conn);
    
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
    exit;
}

//Query for fetching all book in shopping cart
$stmt = $conn->prepare("SELECT book_id, quantity FROM cart_book WHERE cart_id = ?");
$stmt->bind_param("i", $cartId);
$stmt->execute();
$allBooks = $stmt->get_result();

if ($allBooks->num_rows == 0) {

    echo "<div class='alert alert-warning'>Your cart is empty.</div>";
    exit;
}

//Query for insertion IN ORDERS
$insertOrder="INSERT INTO orders(first_name,last_name,address,city,country,phone,email,notes,cart_id) values (?,?,?,?,?,?,?,?,?);";
$stm=$conn->prepare($insertOrder);
$stm->bind_param("ssssssssi",$firstName,$lastName,$address,$city,$country,$phone,$email,$notes,$cartId);
$stm->execute();

$orderId=$conn->insert_id;

//Query for insertion into orders book
$insertBookQuery=
"INSERT INTO order_book VALUES(?,?,?);";

$insertStm=$conn->prepare($insertBookQuery);
//Query for deleting from cart_book

$remodeFromCartQuery=
" DELETE FROM cart_book WHERE cart_id=? AND book_id=?;";

$removeStm=$conn->prepare($remodeFromCartQuery);

while($book = $allBooks->fetch_assoc()){
    $insertStm->bind_param("iii", $orderId, $book['book_id'], $book['quantity']);
    $insertStm->execute();

    $removeStm->bind_param("ii", $cartId, $book['book_id']);
    $removeStm->execute();
}

$insertBillingQuery = "INSERT INTO order_billing_details 
    (order_id, first_name, last_name, email, phone, street_address, city, country, order_notes) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$billingStm = $conn->prepare($insertBillingQuery);
$billingStm->bind_param("issssssss", 
    $orderId,
    $firstName,
    $lastName,
    $email,
    $phone,
    $address,
    $city,
    $country,
    $notes
);

if (!$billingStm->execute()) {
    echo "<div class='alert alert-danger'>Error saving billing details: " . $conn->error . "</div>";
    exit;
}

echo "<script>window.location.href=\"orderSentSuccessfullyPage.php\"</script>";
?>
