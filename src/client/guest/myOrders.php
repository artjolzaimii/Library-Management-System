<?php
include_once("clientMenu.php");
require_once("../../../utilities/config1.php");

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: mainPage.php");
    exit();
}

// Get user ID
$username = $_SESSION['username'];
$userId = getUserId($username);

// Fetch user's orders
$ordersQuery = $conn->prepare("
    SELECT o.*, obd.first_name, obd.last_name, obd.email, obd.phone
    FROM orders o
    LEFT JOIN order_billing_details obd ON o.order_id = obd.order_id
    JOIN shopping_cart sc ON o.cart_id = sc.cart_id
    WHERE sc.user_id = ?
    ORDER BY o.order_date DESC
");
$ordersQuery->bind_param("i", $userId);
$ordersQuery->execute();
$orders = $ordersQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders - Eternal Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("./styleAndScripts.php"); ?>
</head>
<body>
    <?php require("loading.php"); ?>

    <div class="breadcrumb-wrapper bg-cover section-padding"
        style="background-image: url(../assets/img/hero/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="page-heading">
                <h1>My Orders</h1>
                <div class="page-header">
                    <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".3s">
                        <li><a href="mainPage.php">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li>My Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title mb-4">Order History</h3>
                    <?php if ($orders->num_rows > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Books</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $orders->fetch_assoc()): ?>
                                        <tr>
                                            <td>#<?= $row['order_id'] ?></td>
                                            <td><?= date('M d, Y', strtotime($row['order_date'])) ?></td>
                                            <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td><?= htmlspecialchars($row['phone']) ?></td>
                                            
                                            <?php 
                                            // Get books in the order
                                            $bookItems = [];
                                            $bookStmt = $conn->prepare("
                                                SELECT b.title, ob.quantity 
                                                FROM order_book ob 
                                                JOIN book b ON ob.book_id = b.book_id 
                                                WHERE ob.order_id = ?
                                            ");
                                            $bookStmt->bind_param("i", $row['order_id']);
                                            $bookStmt->execute();
                                            $bookRes = $bookStmt->get_result();
                                            while ($b = $bookRes->fetch_assoc()) {
                                                $bookItems[] = "{$b['title']} (x{$b['quantity']})";
                                            }?>
                                            <?php echo "<td>" . implode("<br>", $bookItems) . "</td>" ?>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewBillingModal<?= $row['order_id'] ?>">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <?php include("../../../src/viewOrderDetails.php"); ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fa fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h4>No Orders Yet</h4>
                            <p class="text-muted">You haven't placed any orders yet.</p>
                            <a href="shopList.php" class="theme-btn">Start Shopping</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php include("./footer.php"); ?>
</body>
</html> 