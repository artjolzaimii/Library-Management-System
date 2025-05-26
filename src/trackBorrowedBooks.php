<?php
session_start();
require('../utilities/config.php'); 

// Handle return action
if (isset($_POST['return_book'])) {
    $borrow_id = (int)$_POST['borrow_id'];
    $book_id = (int)$_POST['book_id'];

    // Update inventory
    $conn->query("UPDATE borrow_book SET inventory = inventory + 1 WHERE book_id = $book_id");

    // Delete the borrowed record
    $conn->query("DELETE FROM borrowed_books WHERE id = $borrow_id");

    header("Location: trackBorrowedBooks.php");
    exit;
}

// Pagination settings
$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get total number of records
$total_query = "SELECT COUNT(*) as total FROM borrowed_books";
$total_result = $conn->query($total_query);
$total_records = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Get paginated borrowed books
$query = "SELECT bb.*, b.title as book_title
          FROM borrowed_books bb
          JOIN book b ON bb.book_id = b.book_id
          ORDER BY bb.return_date ASC
          LIMIT $records_per_page OFFSET $offset";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Track Borrowed Books | BookNoW Admin</title>

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico">
    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include('../utilities/menu.php'); ?>

            <div class="layout-page">
                <div class="content-wrapper">
                    <?php include('../utilities/navbar.php'); ?>

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            <span class="text-muted fw-light">Library /</span> Borrowed Books
                        </h4>

                        <div class="card">
                            <h5 class="card-header">Borrowed Books List
                                <a href = "../src/borrow_book.php"type="button" 
                                        class="btn btn-primary" style="float: right; margin-top: -8px;">
                                        Borrow New Book
                                </a>
                            </h5>
                            
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Book Title</th>
                                            <th>Borrower Name</th>
                                            <th>Contact</th>
                                            <th>Borrow Date</th>
                                            <th>Return Date</th>
                                            <th>Return</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['id']) ?></td>
                                                <td><?= htmlspecialchars($row['book_title']) ?></td>
                                                <td><?= htmlspecialchars($row['user_name']) ?></td>
                                                <td>
                                                    <small>
                                                        <strong>Email:</strong> <?= htmlspecialchars($row['user_email']) ?><br>
                                                        <strong>Phone:</strong> <?= htmlspecialchars($row['user_phone']) ?>
                                                    </small>
                                                </td>
                                                <td><?= date('M d, Y', strtotime($row['borrow_date'])) ?></td>
                                                <td><?= date('M d, Y', strtotime($row['return_date'])) ?></td>
                                                <td>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-success" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#returnModal<?= $row['id'] ?>">
                                                        Return
                                                    </button>

                                                    <!-- Return Modal -->
                                                    <div class="modal fade" id="returnModal<?= $row['id'] ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Return Book</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to return "<?= htmlspecialchars($row['book_title']) ?>"?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="POST">
                                                                        <input type="hidden" name="borrow_id" value="<?= htmlspecialchars($row['id']) ?>">
                                                                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($row['book_id']) ?>">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" name="return_book" class="btn btn-success">Confirm Return</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if($total_pages > 1): ?>
                            <div class="card-footer pb-0">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=1"><i class="bx bx-chevrons-left"></i></a>
                                        </li>
                                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= ($page > 1) ? $page - 1 : 1 ?>"><i class="bx bx-chevron-left"></i></a>
                                        </li>
                                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= ($page < $total_pages) ? $page + 1 : $total_pages ?>"><i class="bx bx-chevron-right"></i></a>
                                        </li>
                                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                            <a class="page-link" href="?page=<?= $total_pages ?>"><i class="bx bx-chevrons-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/searchBorrowedBooks.js"></script>

</body>
</html>

<?php $conn->close(); ?>
