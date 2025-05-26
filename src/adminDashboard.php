<?php
require_once('../utilities/config1.php');

// Start session if not already started
ob_start();
session_start();

// Check if user is logged in and has admin role
if (!isset($_SESSION['role']) || (strtolower($_SESSION['role']) !== 'admin')) {
    header("Location: ../client/guest/mainPage.php");
    exit();
}

$query = "SELECT 
    COUNT(DISTINCT u.id) as total_users,
    COUNT(DISTINCT b.book_id) as total_books,
    COUNT(DISTINCT a.author_id) as total_authors,
    COUNT(DISTINCT o.order_id) as total_orders
FROM users u
CROSS JOIN (SELECT 1) as dummy
LEFT JOIN book b ON 1=1
LEFT JOIN author a ON 1=1
LEFT JOIN orders o ON 1=1";

$result = $conn->query($query);
$stats = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | BookNoW</title>
    
    <!-- Include core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/vendor/fonts/boxicons.css" rel="stylesheet" />
    <link href="../assets/vendor/css/core.css" rel="stylesheet" />
    <link href="../assets/vendor/css/theme-default.css" rel="stylesheet" />
    
    <!-- Page specific CSS -->
    <style>
        .stats-card {
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="layout-container">
        <div class="layout-page">
            <div class="content-wrapper">
                <?php include('../utilities/navbar.php'); ?>
                
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Admin /</span> Dashboard
                    </h4>
                    
                    <!-- Stats Cards -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card stats-card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Total Users</h5>
                                    <h2 class="mb-0"><?php echo $stats['total_users']; ?></h2>
                                    <small>Registered users</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card stats-card bg-success text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Total Books</h5>
                                    <h2 class="mb-0"><?php echo $stats['total_books']; ?></h2>
                                    <small>In library</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card stats-card bg-warning text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Total Authors</h5>
                                    <h2 class="mb-0"><?php echo $stats['total_authors']; ?></h2>
                                    <small>Published authors</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card stats-card bg-info text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Total Orders</h5>
                                    <h2 class="mb-0"><?php echo $stats['total_orders']; ?></h2>
                                    <small>Processed orders</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <a href="userManagement.php" class="btn btn-outline-primary w-100">
                                                <i class="bx bx-user me-1"></i> Manage Users
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="authorManagement.php" class="btn btn-outline-primary w-100">
                                                <i class="bx bx-book-reader me-1"></i> Manage Authors
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="addBook.php" class="btn btn-outline-primary w-100">
                                                <i class="bx bx-book-add me-1"></i> Add New Book
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="addUser.php" class="btn btn-outline-primary w-100">
                                                <i class="bx bx-user-plus me-1"></i> Add New User
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Recent Orders</h5>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>User</th>
                                                <th>Date</th>
                                                <th>Books purchased<th>
                                                <th>Quantity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ordersQuery = "SELECT o.order_id, u.full_name, o.order_date, 
                                                          GROUP_CONCAT(CONCAT(b.title,'(', ob.quantity, ')') SEPARATOR ', ') as book_titles,
                                                          SUM(ob.book_id) as total_quantity
                                                          FROM orders o
                                                          JOIN shopping_cart sc ON o.cart_id = sc.cart_id
                                                          JOIN users u ON sc.user_id = u.id
                                                          LEFT JOIN order_book ob ON o.order_id = ob.order_id
                                                          LEFT JOIN book b ON ob.book_id = b.book_id
                                                          GROUP BY o.order_id, u.full_name, o.order_date
                                                          ORDER BY o.order_date DESC
                                                          LIMIT 5";
                                            $ordersResult = $conn->query($ordersQuery);
                                            while ($order = $ordersResult->fetch_assoc()) {
                                                echo "<tr>";                                                
                                                echo "<td>#" . $order['order_id'] . "</td>";
                                                echo "<td>" . htmlspecialchars($order['full_name']) . "</td>";
                                                echo "<td>" . date('M d, Y', strtotime($order['order_date'])) . "</td>";
                                                echo "<td>" . htmlspecialchars($order['book_titles']) . "<td>";
                                                echo "<td>" . $order['total_quantity'] . "</td>";
                                                echo "<td>
                                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#orderModal" . $order['order_id'] . "'>
                                                        <i class='bx bx-show me-1'></i> View Details
                                                    </button>
                                                </td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Modals -->
    <?php
    // Reset the orders result to iterate again for modals
    $ordersResult = $conn->query($ordersQuery);
    while ($order = $ordersResult->fetch_assoc()) {
        echo "
        <div class='modal fade' id='orderModal{$order['order_id']}' tabindex='-1' aria-labelledby='orderModalLabel{$order['order_id']}' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Order Details - #{$order['order_id']}</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <div class='row mb-3'>
                            <div class='col-md-6'>
                                <p><strong>Order ID:</strong> #{$order['order_id']}</p>
                                <p><strong>Order Date:</strong> " . date('M d, Y', strtotime($order['order_date'])) . "</p>
                                <p><strong>Customer Name:</strong> " . htmlspecialchars($order['full_name']) . "</p>
                            </div>
                        </div>
                        
                        <div class='table-responsive'>
                            <h6 class='fw-bold'>Ordered Books</h6>
                            <table class='table table-borderless'>
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                
                                // Get detailed book information
                                $booksQuery = "SELECT b.title, ob.quantity, sb.price 
                                             FROM order_book ob
                                             JOIN book b ON ob.book_id = b.book_id
                                             JOIN sale_book sb ON b.book_id = sb.book_id
                                             WHERE ob.order_id = {$order['order_id']}";
                                $booksResult = $conn->query($booksQuery);
                                $totalAmount = 0;
                                
                                while ($book = $booksResult->fetch_assoc()) {
                                    $subtotal = $book['quantity'] * $book['price'];
                                    $totalAmount += $subtotal;
                                    echo "<tr>
                                            <td>" . htmlspecialchars($book['title']) . "</td>
                                            <td>{$book['quantity']}</td>
                                            <td>$" . number_format($book['price'], 2) . "</td>
                                            <td>$" . number_format($subtotal, 2) . "</td>
                                          </tr>";
                                }
                                
                                echo "<tr class='fw-bold'>
                                        <td colspan='3' class='text-end'>Total:</td>
                                        <td>$" . number_format($totalAmount, 2) . "</td>
                                     </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>";
    }
    ?>

    <!-- Core JS -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
<?php 
$conn->close();
ob_end_flush();
?>
