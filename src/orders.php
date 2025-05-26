<?php
require_once("../utilities/config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="layout-container">
  <?php include('../utilities/menu.php'); ?>
  <div class="layout-page">
    <div class="content-wrapper">
      <?php include('../utilities/navbar.php'); ?>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Order Management /</span> Orders
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-receipt"></i> Orders List</h5>

          <div class="card-body">
            <div class="table-responsive text-nowrap">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Books</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
<?php
$perPage = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $perPage;

$countRes = $conn->query("SELECT COUNT(*) AS total FROM orders");
$totalOrders = $countRes->fetch_assoc()['total'];
$totalPages = ceil($totalOrders / $perPage);

$query = "
  SELECT o.*, u.full_name 
  FROM orders o
  JOIN shopping_cart sc ON o.cart_id = sc.cart_id
  JOIN users u ON sc.user_id = u.id
  ORDER BY o.order_date DESC
  LIMIT ?, ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $offset, $perPage);
$stmt->execute();
$orderResult = $stmt->get_result();

while ($order = $orderResult->fetch_assoc()):
  $order_id = $order['order_id'];

  // Get books in the order
  $bookItems = [];
  $bookStmt = $conn->prepare("
    SELECT b.title, ob.quantity 
    FROM order_book ob 
    JOIN book b ON ob.book_id = b.book_id 
    WHERE ob.order_id = ?
  ");
  $bookStmt->bind_param("i", $order_id);
  $bookStmt->execute();
  $bookRes = $bookStmt->get_result();
  while ($b = $bookRes->fetch_assoc()) {
    $bookItems[] = "{$b['title']} (x{$b['quantity']})";
  }

echo "<tr>
        <td>{$order['order_id']}</td>
        <td>{$order['full_name']}</td>
      <td>" . implode("<br>", $bookItems) . "</td>";

$totalPrice = 0;
$priceStmt = $conn->prepare("
  SELECT ob.quantity,
         COALESCE(sb.price, 0) AS sale_price
  FROM order_book ob
  LEFT JOIN sale_book sb ON ob.book_id = sb.book_id
  WHERE ob.order_id = ?
");
$priceStmt->bind_param("i", $order_id);
$priceStmt->execute();
$priceRes = $priceStmt->get_result();
while ($row = $priceRes->fetch_assoc()) {
    $totalPrice += $row['quantity'] * $row['sale_price'];
}

echo "<td>€" . number_format($totalPrice, 2) . "</td>";


echo "<td>
          <select class='form-select form-select-sm' onchange='updateStatus({$order['order_id']}, this.value)'>
            <option value='Pending'" . ($order['status'] === 'Pending' ? ' selected' : '') . ">Pending</option>
            <option value='Shipped'" . ($order['status'] === 'Shipped' ? ' selected' : '') . ">Shipped</option>
            <option value='Completed'" . ($order['status'] === 'Completed' ? ' selected' : '') . ">Completed</option>
            <option value='Canceled'" . ($order['status'] === 'Canceled' ? ' selected' : '') . ">Canceled</option>
          </select>
        </td>
        <td>{$order['order_date']}</td>
        <td>
          <button class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#viewBillingModal{$order_id}'>
            <i class='bx bx-show'></i>
          </button>
        </td>
      </tr>";

  // Billing modal
  echo "<div class='modal fade' id='viewBillingModal{$order_id}' tabindex='-1'>
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title'>Billing Details - Order #{$order_id}</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
              </div>
              <div class='modal-body'>
                <p><strong>First Name:</strong> {$order['first_name']}</p>
                <p><strong>Last Name:</strong> {$order['last_name']}</p>
                <p><strong>Country:</strong> {$order['country']}</p>
                <p><strong>Address:</strong> {$order['address']}, {$order['city']}</p>
                <p><strong>Phone:</strong> {$order['phone']}</p>
                <p><strong>Email:</strong> {$order['email']}</p>
                <p><strong>Notes:</strong><br>" . nl2br($order['notes']) . "</p>
              </div>
            </div>
          </div>
        </div>";
endwhile;
?>
                </tbody>
              </table>

<!-- Pagination -->
<div class="card-body">
  <nav>
    <ul class="pagination justify-content-center">
      <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=1"><i class="bx bx-chevrons-left"></i></a>
      </li>
      <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= max(1, $currentPage - 1); ?>"><i class="bx bx-chevron-left"></i></a>
      </li>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
      <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= min($totalPages, $currentPage + 1); ?>"><i class="bx bx-chevron-right"></i></a>
      </li>
      <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= $totalPages ?>"><i class="bx bx-chevrons-right"></i></a>
      </li>
    </ul>
  </nav>
</div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap + JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function updateStatus(orderId, newStatus) {
  fetch("", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "update_order_status=1&order_id=" + orderId + "&status=" + encodeURIComponent(newStatus)
  }).then(res => res.text())
    .then(msg => console.log(msg))
    .catch(err => console.error(err));
}
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order_status'])) {
  $order_id = intval($_POST['order_id']);
  $status = $_POST['status'];
  $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
  $stmt->bind_param("si", $status, $order_id);
  $stmt->execute();
  exit("Status updated");
}
?>


      <!-- JS Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
  <script src="../assets/vendor/libs/jquery/jquery.js"></script>
  <script src="../assets/vendor/libs/popper/popper.js"></script>
  <script src="../assets/vendor/js/bootstrap.js"></script>
  <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

  <script src="../assets/vendor/js/menu.js"></script> 

  <!-- Main JS -->
  <script src="../assets/js/main.js"></script>
</body>
</html>
