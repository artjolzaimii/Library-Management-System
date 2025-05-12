<?php
require('../utilities/config.php');
header('Content-Type: application/json');

// Step 1: Fetch unreported orders
$query = "
    SELECT o.*, b.title 
    FROM orders o
    JOIN books b ON o.book_id = b.book_id
    WHERE o.report_id IS NULL
";

$result = mysqli_query($conn, $query);

$total_sold = 0;
$total_revenue = 0.0;
$book_sales = [];

while ($row = mysqli_fetch_assoc($result)) {
    $total_sold += $row['quantity'];
    $total_revenue += $row['total_amount'];

    $title = $row['title'];
    if (!isset($book_sales[$title])) {
        $book_sales[$title] = 0;
    }
    $book_sales[$title] += $row['quantity'];

    $order_ids[] = $row['order_id'];
}

// Step 2: If there are no unreported orders
if ($total_sold === 0) {
    echo json_encode(['success' => false, 'message' => 'No new orders to report.']);
    exit;
}

// Step 3: Determine most sold book
arsort($book_sales);
$most_sold_book = array_key_first($book_sales);

// Step 4: Insert the report
$insert = mysqli_query($conn, "
    INSERT INTO sales_reports (total_books_sold, most_sold_book, total_revenue) 
    VALUES ('$total_sold', '$most_sold_book', '$total_revenue')
");

if ($insert) {
    $report_id = mysqli_insert_id($conn);

    // Step 5: Mark these orders as reported
    $order_ids_str = implode(',', array_map('intval', $order_ids));
    mysqli_query($conn, "
        UPDATE orders 
        SET report_id = $report_id 
        WHERE order_id IN ($order_ids_str)
    ");

    // Step 6: Return the inserted report data
    $get = mysqli_query($conn, "SELECT * FROM sales_reports WHERE report_id = $report_id");
    $report = mysqli_fetch_assoc($get);
    echo json_encode(['success' => true, 'report' => $report]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save report.']);
}
