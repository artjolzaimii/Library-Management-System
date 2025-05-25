<?php
session_start();
require('../utilities/config.php');

// Delete report using prepared statement
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_stmt = $conn->prepare("DELETE FROM sales_reports WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        header("Location: generateReport.php");
        exit;
    } else {
        echo "Error deleting report: " . $conn->error;
        exit;
    }
}

// Handle report generation via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['generateReport'])) {
    $start_date = filter_var($_POST["start_date"], FILTER_SANITIZE_STRING);
    $end_date = filter_var($_POST["end_date"], FILTER_SANITIZE_STRING);

    // Validate dates
    if (!strtotime($start_date) || !strtotime($end_date) || strtotime($end_date) < strtotime($start_date)) {
        echo "Invalid date range.";
        exit;
    }

    // Total books sold and total revenue
    $query = "
        SELECT 
            SUM(ob.quantity) AS total_sold,
            SUM(ob.quantity * sb.price) AS total_revenue
        FROM order_book ob
        JOIN orders o ON ob.order_id = o.order_id
        JOIN sale_book sb ON ob.book_id = sb.book_id
        WHERE o.order_date BETWEEN ? AND ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $total_sold = $row['total_sold'] ?? 0;
    $total_revenue = $row['total_revenue'] ?? 0;

    // Most sold book
    $query2 = "
        SELECT 
            b.title, 
            SUM(ob.quantity) AS total_qty
        FROM order_book ob
        JOIN book b ON ob.book_id = b.book_id
        JOIN orders o ON ob.order_id = o.order_id
        WHERE o.order_date BETWEEN ? AND ?
        GROUP BY ob.book_id
        ORDER BY total_qty DESC
        LIMIT 1
    ";

    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("ss", $start_date, $end_date);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row2 = $result2->fetch_assoc();
    $most_sold_book = $row2['title'] ?? "No sales";

    // Insert into sales_reports
    $insert_query = "
        INSERT INTO sales_reports (report_date, total_books_sold, most_sold_book, total_revenue, start_date, end_date)
        VALUES (NOW(), ?, ?, ?, ?, ?)
    ";
    $stmt3 = $conn->prepare($insert_query);
    $stmt3->bind_param("isdss", $total_sold, $most_sold_book, $total_revenue, $start_date, $end_date);
    if ($stmt3->execute()) {
        header("Location: generateReport.php");
        exit;
    } else {
        echo "Error generating report: " . $conn->error;
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Sales Report | BookNoW Admin</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css">
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
                    <span class="text-muted fw-light">Report Management /</span> Sales Report
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
                                                <button class='btn btn-sm btn-info' data-bs-toggle='modal'
                                                        data-bs-target='#viewReportModal'
                                                        data-report-id='{$report['id']}'>
                                                    View
                                                </button>
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
</div>

<!-- Generate report modal -->
<div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="generateReport.php" class="modal-content" id="generateReportForm">
      <div class="modal-header">
        <h5 class="modal-title" id="generateReportModalLabel">Generate Sales Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="start_date" class="form-label">Start Date</label>
          <input type="date" class="form-control" name="start_date" id="start_date" required max="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="mb-3">
          <label for="end_date" class="form-label">End Date</label>
          <input type="date" class="form-control" name="end_date" id="end_date" required max="<?php echo date('Y-m-d'); ?>">
        </div>
        <div id="dateError" class="text-danger" style="display: none;">End date must be after start date</div>
        <input type="hidden" name="generateReport" value="1">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Generate</button>
      </div>
    </form>
  </div>
</div>

<!-- View report modal -->
<div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewReportModalLabel">Report Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="reportDetailsContent">
          <p>Loading report details...</p>
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
document.addEventListener('DOMContentLoaded', function () {
    // Generate Report Modal
    const generateReportBtn = document.getElementById('generateReportBtn');
    const generateReportModal = document.getElementById('generateReportModal');
    const generateReportForm = document.getElementById('generateReportForm');

    if (generateReportBtn && generateReportModal && generateReportForm) {
        let modalInstance;
        try {
            modalInstance = new bootstrap.Modal(generateReportModal);
        } catch (error) {
            console.error('Generate modal initialization failed:', error);
            return;
        }

        generateReportBtn.addEventListener('click', function () {
            // Reset form and error messages
            generateReportForm.reset();
            document.getElementById('dateError').style.display = 'none';
            modalInstance.show();
        });

        // Date validation
        generateReportForm.addEventListener('submit', function (event) {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const dateError = document.getElementById('dateError');

            if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
                event.preventDefault();
                dateError.style.display = 'block';
            } else {
                dateError.style.display = 'none';
            }
        });

        document.getElementById('start_date').onpaste = e => e.preventDefault();
        document.getElementById('end_date').onpaste = e => e.preventDefault();
    } else {
        console.warn('Generate report elements not found in DOM');
    }

    // View Report Modal
    const viewModal = document.getElementById('viewReportModal');
    const reportDetailsContent = document.getElementById('reportDetailsContent');

    if (viewModal && reportDetailsContent) {
        let viewModalInstance;
        try {
            viewModalInstance = new bootstrap.Modal(viewModal);
        } catch (error) {
            console.error('View modal initialization failed:', error);
            return;
        }

        viewModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const reportId = parseInt(button.getAttribute('data-report-id'));

            if (!reportId || isNaN(reportId)) {
                reportDetailsContent.innerHTML = "<p class='text-danger'>Invalid report ID.</p>";
                return;
            }

            reportDetailsContent.innerHTML = "<p>Loading...</p>";

            fetch(`fetchReportDetails.php?report_id=${encodeURIComponent(reportId)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'text/html'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    reportDetailsContent.innerHTML = data;
                })
                .catch(err => {
                    reportDetailsContent.innerHTML = "<p class='text-danger'>Failed to load details. Please try again.</p>";
                    console.error('Fetch error:', err);
                });
        });

        // Reset modal content when hidden
        viewModal.addEventListener('hidden.bs.modal', function () {
            reportDetailsContent.innerHTML = "<p>Loading report details...</p>";
        });
    } else {
        console.warn('View report modal elements not found in DOM');
    }
});
</script>
</body>
</html>