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
               JOIN books b ON o.book_id = b.book_id 
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
    header("Location: sales_report.php");
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
                                    <th>Total Sold</th>
                                    <th>Most Sold Book</th>
                                    <th>Revenue</th>
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
                                                <td>" . ($report['most_sold_book']) . "</td>
                                                <td>$" . number_format($report['total_revenue'], 2) . "</td>
                                                <td>
                                                <button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#reportModal{$report['id']}'>View</button>
                                                <a href='generateReport.php?delete_id={$report['id']}' class='btn btn-sm btn-danger' onclick='return confirm('Are you sure you want to delete this user?');'>Delete</a>
                                              </td>";
                                        echo "</tr>";


                                        // Modal for each saved report
                                        echo "
                                        <div class='modal fade' id='reportModal{$report['id']}' aria-hidden='true'>
                                          <div class='modal-dialog'>
                                            <div class='modal-content'>
                                              <div class='modal-header'>
                                                <h5 class='modal-title'>Sales Report - {$report['report_date']}</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                              </div>
                                              <div class='modal-body'>
                                                <p><strong>Report ID:</strong> {$report['id']}</p>
                                                <p><strong>Total Books Sold:</strong> {$report['total_books_sold']}</p>
                                                <p><strong>Most Sold Book:</strong> " . ($report['most_sold_book']) . "</p>
                                                <p><strong>Total Revenue:</strong> $" . number_format($report['total_revenue'], 2) . "</p>
                                                <p><strong>From Date:</strong> {$report['start_date']}</p>
                                                <p><strong>To Date:</strong> {$report['end_date']}</p>
                                              </div>
                                              <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No reports yet</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Sales Report Modal -->
                <div class="modal fade" id="salesReportModal" tabindex="-1" aria-labelledby="salesReportModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="salesReportModalLabel">Sales Report Summary</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $total_books_query = "SELECT SUM(quantity) AS total_books FROM orders";
                                $total_books_result = mysqli_query($conn, $total_books_query);
                                $total_books = mysqli_fetch_assoc($total_books_result)['total_books'] ?? 0;

                                $revenue_query = "SELECT SUM(total_amount) AS total_revenue FROM orders";
                                $revenue_result = mysqli_query($conn, $revenue_query);
                                $total_revenue = mysqli_fetch_assoc($revenue_result)['total_revenue'] ?? 0;

                                $top_book_query = "SELECT b.title, SUM(o.quantity) AS total_sold 
                                                    FROM orders o
                                                    JOIN books b ON o.book_id = b.book_id
                                                    GROUP BY o.book_id 
                                                    ORDER BY total_sold DESC 
                                                    LIMIT 1";
                                $top_book_result = mysqli_query($conn, $top_book_query);
                                $top_book_row = mysqli_fetch_assoc($top_book_result);
                                $top_book = $top_book_row['title'] ?? 'N/A';
                                $top_book_sold = $top_book_row['total_sold'] ?? 0;
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Books Sold</h6>
                                                <p class="card-text fs-4 fw-bold"><?= ($total_books) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Revenue</h6>
                                                <p class="card-text fs-4 fw-bold">$<?= number_format($total_revenue, 2) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h6 class="card-title">Most Sold Book</h6>
                                                <p class="card-text fs-5"><?= htmlspecialchars($top_book) ?></p>
                                                <small><?= htmlspecialchars($top_book_sold) ?> copies sold</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
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
document.getElementById("generateReportBtn").addEventListener("click", function () {
    fetch("save_report.php", { method: "POST" })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const table = document.querySelector("table tbody");
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${data.report.id}</td>
                    <td>${data.report.report_date}</td>
                    <td>${data.report.total_books_sold}</td>
                    <td>${data.report.most_sold_book}</td>
                    <td>$${parseFloat(data.report.total_revenue).toFixed(2)}</td>
                    <td><button class='btn btn-sm btn-info' data-bs-toggle='modal' data-bs-target='#reportModal${data.report.id}'>View</button></td>
                `;
                table.prepend(newRow);

                const modalHTML = `
                <div class='modal fade' id='reportModal${data.report.id}' tabindex='-1' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title'>Sales Report - ${data.report.report_date}</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                            </div>
                            <div class='modal-body'>
                                <p><strong>Total Books Sold:</strong> ${data.report.total_books_sold}</p>
                                <p><strong>Most Sold Book:</strong> ${data.report.most_sold_book}</p>
                                <p><strong>Total Revenue:</strong> $${parseFloat(data.report.total_revenue).toFixed(2)}</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>`;
                document.body.insertAdjacentHTML('beforeend', modalHTML);

                const reportModal = new bootstrap.Modal(document.getElementById(`reportModal${data.report.id}`));
                reportModal.show();
            } else {
                alert("Failed to generate report.");
            }
        });
});
</script>

</body>
</html>