<?php
session_start();
require('../utilities/config.php');

$books = mysqli_query($conn, "
    SELECT *
    FROM book AS b
    INNER JOIN borrow_book AS bb ON b.book_id = bb.book_id
    WHERE b.format = 'For Borrow'
    ORDER BY b.title ASC
");

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Borrow Book | Eternal Library</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
    <link rel="stylesheet" href="../assets/css/demo.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
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
                            <span class="text-muted fw-light">Library /</span> Borrow a Book
                        </h4>

                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="userDetailsForBorrowing.php">
                                    <div class="mb-3">
                                        <label for="book_id" class="form-label">Select Book</label>
                                        <select name="book_id" id="book_id" class="form-select" required>
                                            <option value="">-- Choose a Book --</option>
                                            <?php while ($book = mysqli_fetch_assoc($books)): ?>
                                                <option value="<?= htmlspecialchars($book['book_id']) ?>"
                                                        data-inventory="<?= htmlspecialchars($book['inventory']) ?>"
                                                        <?= $book['inventory'] <= 0 ? 'disabled' : '' ?>>
                                                    <?= htmlspecialchars($book['title']) ?> 
                                                    (ISBN: <?= htmlspecialchars($book['isbn']) ?>) 
                                                    - Available: <?= htmlspecialchars($book['inventory']) ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="borrow_date" class="form-label">Borrow Date</label>
                                            <input type="date" name="borrow_date" id="borrow_date" 
                                                   class="form-control" required>   
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="return_date" class="form-label">Return Date</label>
                                            <input type="date" name="return_date" id="return_date" 
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Continue</button>
                                        
                                    </div>
                                </form>
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

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
              // Initialize Select2
            $('#book_id').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: '-- Choose a Book --',
                allowClear: true,
                minimumInputLength: 0, // Show all options by default
                minimumResultsForSearch: 0, // Always show search box
                dropdownParent: $('#book_id').parent(),
                templateResult: formatBook,
                templateSelection: formatBookSelection
            });

            // Custom template for dropdown items
            function formatBook(book) {
                if (!book.id) return book.text;
                var $container = $(
                    '<div class="book-option">' +
                        '<div class="book-info">' + book.text + '</div>' +
                    '</div>'
                );
                return $container;
            }

            // Custom template for selected item
            function formatBookSelection(book) {
                if (!book.id) return book.text;
                return book.text;
            }

            // Set minimum dates
            const today = new Date().toISOString().split('T')[0];
            const borrowDateInput = document.getElementById('borrow_date');
            const returnDateInput = document.getElementById('return_date');

            borrowDateInput.min = today;
            
            // Update return date minimum when borrow date changes
            borrowDateInput.addEventListener('change', function() {
                returnDateInput.min = this.value;
                
                // If return date is before new borrow date, update it
                if (returnDateInput.value && returnDateInput.value < this.value) {
                    returnDateInput.value = this.value;
                }
            });

            // Set maximum borrowing period (e.g., 30 days)
            borrowDateInput.addEventListener('change', function() {
                if (this.value) {
                    const maxDate = new Date(this.value);
                    maxDate.setDate(maxDate.getDate() + 30);
                    returnDateInput.max = maxDate.toISOString().split('T')[0];
                }
            });
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>