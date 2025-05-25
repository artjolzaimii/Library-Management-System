<?php
if (!isset($row) || !isset($row['order_id'])) {
    die("Error: Order data not provided");
}

$order_id = $row['order_id'];
$billingQuery = $conn->prepare("SELECT * FROM order_billing_details WHERE order_id = ?");
$billingQuery->bind_param("i", $order_id);
$billingQuery->execute();
$billing = $billingQuery->get_result()->fetch_assoc();
?>

<div class="modal fade" id="viewBillingModal<?= $order_id ?>" tabindex="-1" aria-labelledby="billingModalLabel<?= $order_id ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Billing Details - Order #<?= $order_id ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>First Name:</strong> <?= $billing['first_name'] ?? 'N/A' ?></p>
        <p><strong>Last Name:</strong> <?= $billing['last_name'] ?? 'N/A' ?></p>
        <p><strong>Company:</strong> <?= $billing['company_name'] ?? 'N/A' ?></p>
        <p><strong>Country:</strong> <?= $billing['country'] ?? 'N/A' ?></p>
        <p><strong>Address:</strong> <?= $billing['street_address'] ?? '' ?> <?= $billing['apartment_suite'] ?? '' ?></p>
        <p><strong>City:</strong> <?= $billing['city'] ?? 'N/A' ?></p>
        <p><strong>Phone:</strong> <?= $billing['phone'] ?? 'N/A' ?></p>
        <p><strong>Email:</strong> <?= $billing['email'] ?? 'N/A' ?></p>
        <p><strong>Order Notes:</strong><br><?= nl2br($billing['order_notes'] ?? '') ?></p>
      </div>
    </div>
  </div>
</div>
