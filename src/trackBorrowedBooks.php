<?php
require('../utilities/config.php'); 

// Handle return action
if (isset($_POST['return_book'])) {
    $borrow_id = $_POST['borrow_id'];
    $book_id = $_POST['book_id'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Update inventory
        $update_query = "UPDATE borrow_book SET inventory = inventory + 1 WHERE book_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        // Delete the borrowed record
        $delete_query = "DELETE FROM borrowed_books WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $borrow_id);
        $stmt->execute();

        $conn->commit();
        header("Location: trackBorrowedBooks.php");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Error returning book: " . $e->getMessage() . "');</script>";
    }
}

// Get all borrowed books with book details
$query = "SELECT bb.*, b.title as book_title, b.isbn 
          FROM borrowed_books bb
          JOIN book b ON bb.book_id = b.book_id
          ORDER BY bb.borrow_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Track Borrowed Books | BookNoW Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
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

                        <!-- Borrowed Books Table -->
                        <div class="card">
                            <h5 class="card-header">Borrowed Books List</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Book Title</th>
                                            <th>ISBN</th>
                                            <th>Borrower Name</th>
                                            <th>Contact</th>
                                            <th>Borrow Date</th>
                                            <th>Return Date</th>
                                            <th>Retrun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['id']) ?></td>
                                                <td><?= htmlspecialchars($row['book_title']) ?></td>
                                                <td><?= htmlspecialchars($row['isbn']) ?></td>
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
                                                    <?php
                                                    $today = new DateTime();
                                                    $returnDate = new DateTime($row['return_date']);
                                                    
                                                    ?>
                                                     <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="borrow_id" value="<?= htmlspecialchars($row['id']) ?>">
                                                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($row['book_id']) ?>">
                                                        <button type="submit" 
                                                                name="return_book" 
                                                                class="btn btn-sm btn-success"
                                                                onclick="return confirm('Are you sure you want to return this book?');">
                                                            Return
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>

<?php $conn->close(); ?>