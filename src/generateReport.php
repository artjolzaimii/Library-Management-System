<?php
session_start();
require('../utilities/config.php');
//Delete report
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
  $delete_query = "DELETE FROM sales_reports WHERE id = $delete_id";
  if ($conn->query($delete_query) === TRUE) {
      header("Location: generateReport.php");
      exit;
  }
}
// Save report if generateReport=1 is in the URL
if (isset($_GET['generateReport'])) {
    // Calculate report data
    $query = "SELECT SUM(o.quantity) AS total_sold, SUM(o.total_amount) AS total_revenue FROM orders o";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_sold = $row['total_sold'] ?? 0;
    $total_revenue = $row['total_revenue'] ?? 0;

    $query2 = "SELECT b.title, SUM(o.quantity) AS total_qty 
               FROM orders o 
               JOIN book b ON o.book_id = b.book_id 
               GROUP BY o.book_id 
               ORDER BY total_qty DESC 
               LIMIT 1";
    $result2 = mysqli_query($conn, $query2);
    $most_sold_book = ($result2 && mysqli_num_rows($result2) > 0) ? mysqli_fetch_assoc($result2)['title'] : 'N/A';

    // Insert report
    $insert = "INSERT INTO sales_reports (total_books_sold, most_sold_book, total_revenue) 
               VALUES ('$total_sold', '$most_sold_book', '$total_revenue')";
    mysqli_query($conn, $insert);

    // Redirect to clean the URL
    header("Location: generateReport.php");
    exit;
}
?>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Sales Report | BookNoW Admin</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico">

  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css">

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css">
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
  <link rel="stylesheet" href="../assets/css/demo.css">
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">

</head>
<body>
<div class="layout-container">
    <?php include('../utilities/menu.php'); ?>
    <div class="layout-page">
        <div class="content-wrapper">
            <?php include('../utilities/navbar.php'); ?>

            <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Admin /</span> Sales Report
          </h4>

                <!-- Report History -->
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Generated Sales Reports</h5>
                        <button id="generateReportBtn" class="btn btn-primary">Generate Report</button>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Total Books Sold</th>
                                    <th>Most Sold Book</th>
                                    <th>Total Revenue</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $reportQuery = "SELECT * FROM sales_reports ORDER BY report_date DESC";
                                $reportResult = mysqli_query($conn, $reportQuery);

                                if ($reportResult && mysqli_num_rows($reportResult) > 0) {
                                    while ($report = mysqli_fetch_assoc($reportResult)) {
                                        echo "<tr>
                                            <td>{$report['id']}</td>
                                            <td>{$report['report_date']}</td>
                                            <td>{$report['total_books_sold']}</td>
                                            <td>" . htmlspecialchars($report['most_sold_book']) . "</td>
                                            <td>$" . number_format($report['total_revenue'], 2) . "</td>
                                            <td>
                                                <a href='generateReport.php?delete_id={$report['id']}' 
                                                   class='btn btn-sm btn-danger' 
                                                   onclick='return confirm(\"Are you sure you want to delete this report?\");'>
                                                   Delete
                                                </a>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No reports available</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>

<script>
document.getElementById('generateReportBtn').addEventListener('click', function() {
    window.location.href = 'generateReport.php?generateReport=1';
});
</script>

</body>
</html>

<?php $conn->close(); ?>