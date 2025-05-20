<?php 
require_once("../utilities/config.php");
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
                    <th>Book Title</th>
                    <th>Quantity</th>
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

                    $countRes = $conn->query("SELECT COUNT(*) as total FROM orders");
                    $totalOrders = $countRes->fetch_assoc()['total'];
                    $totalPages = ceil($totalOrders / $perPage);

                    $query = "SELECT o.*, u.full_name, b.title 
                              FROM orders o 
                              JOIN users u ON o.user_id = u.id 
                              JOIN book b ON o.book_id = b.book_id 
                              ORDER BY o.order_date DESC
                              LIMIT $offset, $perPage";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                      $order_id = $row['order_id'];
                      $billingQuery = $conn->prepare("SELECT * FROM order_billing_details WHERE order_id = ?");
                      $billingQuery->bind_param("i", $order_id);
                      $billingQuery->execute();
                      $billing = $billingQuery->get_result()->fetch_assoc();

                      echo "<tr>
                              <td>{$row['order_id']}</td>
                              <td>{$row['full_name']}</td>
                              <td>{$row['title']}</td>
                              <td>{$row['quantity']}</td>
                              <td>€{$row['total_price']}</td>
                              <td>
                                <select class='form-select form-select-sm' onchange='updateStatus({$row['order_id']}, this.value)'>
                                  <option value='Pending'" . ($row['status'] === 'Pending' ? ' selected' : '') . ">Pending</option>
                                  <option value='Shipped'" . ($row['status'] === 'Shipped' ? ' selected' : '') . ">Shipped</option>
                                  <option value='Completed'" . ($row['status'] === 'Completed' ? ' selected' : '') . ">Completed</option>
                                  <option value='Canceled'" . ($row['status'] === 'Canceled' ? ' selected' : '') . ">Canceled</option>
                                </select>
                              </td>
                              <td>{$row['order_date']}</td>
                              <td>
                                <button type='button' class='btn btn-outline-primary btn-sm' data-bs-toggle='modal' data-bs-target='#viewBillingModal{$row['order_id']}'>
                                  <i class='bx bx-show'></i>
                                </button>
                              </td>
                            </tr>";

                      echo "<div class='modal fade' id='viewBillingModal{$row['order_id']}' tabindex='-1' aria-labelledby='billingModalLabel{$row['order_id']}' aria-hidden='true'>
                      
                              <div class='modal-dialog modal-lg'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title'>Billing Details - Order #{$row['order_id']}</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                  </div>
                                  <div class='modal-body'>
                                  
                                    <p><strong>First Name:</strong> {$billing['first_name']}</p>
                                    <p><strong>Last Name:</strong> {$billing['last_name']}</p>
                                    <p><strong>Company:</strong> {$billing['company_name']}</p>
                                    <p><strong>Country:</strong> {$billing['country']}</p>
                                    <p><strong>Address:</strong> {$billing['street_address']} {$billing['apartment_suite']}</p>
                                    <p><strong>City:</strong> {$billing['city']}</p>
                                    <p><strong>Phone:</strong> {$billing['phone']}</p>
                                    <p><strong>Email:</strong> {$billing['email']}</p>
                                    <p><strong>Order Notes:</strong><br>" . nl2br($billing['order_notes']) . "</p>
                                  </div>
                                </div>
                              </div>
                            </div>";
                    }
                  ?>
                </tbody>
              </table>
              <!-- Pagination -->
<div class="card-body">
  <div class="row">
    <div class="col">
      <div class="demo-inline-spacing">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item first">
              <a class="page-link" href="orders.php?page=1">
                <i class="tf-icon bx bx-chevrons-left"></i>
              </a>
            </li>
            <li class="page-item prev">
              <a class="page-link" href="orders.php?page=<?= max(1, $currentPage - 1); ?>">
                <i class="tf-icon bx bx-chevron-left"></i>
              </a>
            </li>
            <?php 
              for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item " . ($currentPage == $i ? "active" : "") . "'>
                        <a class='page-link' href='orders.php?page=$i'>$i</a>
                      </li>";
              }
            ?>
            <li class="page-item next">
              <a class="page-link" href="orders.php?page=<?= min($totalPages, $currentPage + 1); ?>">
                <i class="tf-icon bx bx-chevron-right"></i>
              </a>
            </li>
            <li class="page-item last">
              <a class="page-link" href="orders.php?page=<?= $totalPages; ?>">
                <i class="tf-icon bx bx-chevrons-right"></i>
              </a>
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
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function updateStatus(orderId, newStatus) {
  fetch('', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `update_order_status=1&order_id=${orderId}&status=${encodeURIComponent(newStatus)}`
  })
  .then(response => response.text())
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));
}
</script>

<?php
// Process status update via POST (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order_status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    exit("Status updated");
}
?>

</body>
</html>
