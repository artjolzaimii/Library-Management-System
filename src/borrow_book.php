<?php
require('../utilities/config.php');

// Handle book borrow
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $borrower_name = mysqli_real_escape_string($conn, $_POST['borrower_name']);

    $insert = "INSERT INTO borrowed_books (book_id, borrower_name) 
               VALUES ('$book_id', '$borrower_name')";
    mysqli_query($conn, $insert);
    echo "<script>alert('Book borrowed successfully!'); window.location.href='borrow_book.php';</script>";
}

// Fetch all books
$books = mysqli_query($conn, "SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Book | BookNoW Admin</title>
    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <h3 class="mb-4">Borrow a Book</h3>
    <form method="POST" action="borrow_book.php">
        <div class="mb-3">
            <label for="book_id" class="form-label">Select Book</label>
            <select name="book_id" id="book_id" class="form-select" required>
                <option value="">-- Choose a Book --</option>
                <?php while ($book = mysqli_fetch_assoc($books)): ?>
                    <option value="<?= $book['book_id'] ?>"><?= htmlspecialchars($book['title']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="borrower_name" class="form-label">Borrower's Name</label>
            <input type="text" name="borrower_name" id="borrower_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Borrow</button>
    </form>
</div>
</body>
</html>
