<?php
session_start();
require('../utilities/config.php');

if (isset($_GET['report_id'])) {
    $report_id = intval($_GET['report_id']);

    // Get report dates
    $stmt = $conn->prepare("SELECT start_date, end_date FROM sales_reports WHERE id = ?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $report = $stmt->get_result()->fetch_assoc();

    if (!$report) {
        echo "<p class='text-danger'>Report not found.</p>";
        exit;
    }

    $start_date = $report['start_date'];
    $end_date = $report['end_date'];

    // Fetch book sales details
    $query = "SELECT b.title, SUM(ob.quantity) AS qty_sold, COUNT(DISTINCT o.order_id) AS order_count
        FROM order_book ob
        JOIN book b ON ob.book_id = b.book_id
        JOIN orders o ON ob.order_id = o.order_id
        WHERE o.order_date BETWEEN ? AND ?
        GROUP BY b.book_id
        ORDER BY qty_sold DESC
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>Title</th><th>Quantity Sold</th><th>Number of Orders</th></tr></thead><tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['title']) . "</td>
                    <td>{$row['qty_sold']}</td>
                    <td>{$row['order_count']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center'>No sales data available for this period.</td></tr>";
    }
    echo "</tbody></table>";

    $stmt->close();
} else {
    echo "<p class='text-danger'>Invalid report ID.</p>";
}
?>