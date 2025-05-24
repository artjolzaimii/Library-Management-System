<?php
require_once("../utilities/config.php");

$bookId = $row['book_id'];

$bookQuery = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
$bookQuery->bind_param("i", $bookId);
$bookQuery->execute();
$book = $bookQuery->get_result()->fetch_assoc();

// Fetch authors
$authors = [];
$authorQuery = $conn->prepare("SELECT full_name FROM author a JOIN book_author ba ON a.author_id = ba.author_id WHERE ba.book_id = ?");
$authorQuery->bind_param("i", $bookId);
$authorQuery->execute();
$authorResult = $authorQuery->get_result();
while ($a = $authorResult->fetch_assoc()) {
    $authors[] = $a['full_name'];
}

// Fetch genres
$genres = [];
$genreQuery = $conn->prepare("SELECT name FROM genres g JOIN book_genre bg ON g.id = bg.genre_id WHERE bg.book_id = ?");
$genreQuery->bind_param("i", $bookId);
$genreQuery->execute();
$genreResult = $genreQuery->get_result();
while ($g = $genreResult->fetch_assoc()) {
    $genres[] = $g['name'];
}
?>

<!-- View Book Modal -->




<div class="modal fade" id="viewBookModal<?= $bookId ?>" tabindex="-1" aria-labelledby="viewBookLabel<?= $bookId ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewBookLabel<?= $bookId ?>">View Book - <?= htmlspecialchars($book['title']) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">

        <div class="row">
          <div class="col-md-4">
            <img src="../uploads/images/<?= $book['image_path'] ?>" alt="Book Cover" class="img-fluid rounded">
          </div>
          <div class="col-md-8">
            <p><strong>ISBN:</strong> <?= $book['isbn'] ?></p>
            <p><strong>Title:</strong> <?= $book['title'] ?></p>
            <p><strong>Authors:</strong> <?= implode(", ", $authors) ?></p>
            <p><strong>Genres:</strong> <?= implode(", ", $genres) ?></p>
            <p><strong>Publication Year:</strong> <?= $book['publication_year'] ?></p>
            <p><strong>Publisher:</strong> <?= $book['publisher'] ?></p>
            <p><strong>Language:</strong> <?= $book['language'] ?></p>
            <p><strong>Pages:</strong> <?= $book['nr_pages'] ?></p>
           


            <?php
$price = "N/A";
$inventory = "N/A";

if ($book['format'] === 'For Sale') {
    $saleQuery = $conn->prepare("SELECT price, inventory FROM sale_book WHERE book_id = ?");
    $saleQuery->bind_param("i", $bookId);
    $saleQuery->execute();
    $saleResult = $saleQuery->get_result()->fetch_assoc();
    if ($saleResult) {
        $price = $saleResult['price'] . ' €';
        $inventory = $saleResult['inventory'];
    }
} elseif ($book['format'] === 'For Borrow') {
    $borrowQuery = $conn->prepare("SELECT inventory FROM borrow_book WHERE book_id = ?");
    $borrowQuery->bind_param("i", $bookId);
    $borrowQuery->execute();
    $borrowResult = $borrowQuery->get_result()->fetch_assoc();
    if ($borrowResult) {
        $inventory = $borrowResult['inventory'];
    }
}
?>

<p><strong>Price:</strong> <?= htmlspecialchars($price) ?></p>
<p><strong>Inventory:</strong> <?= htmlspecialchars($inventory) ?></p>

            <p><strong>Format:</strong> <?= $book['format'] ?></p>
            <p style="white-space: pre-wrap; word-wrap: break-word;"><strong>Description:</strong><br><?= nl2br(htmlspecialchars($book['description'])) ?></p>


        

<?php if ($book['format'] === 'For Borrow'): 
    $condQuery = $conn->prepare("SELECT book_condition FROM borrow_book WHERE book_id = ?");
    $condQuery->bind_param("i", $bookId);
    $condQuery->execute();
    $condResult = $condQuery->get_result()->fetch_assoc();
    $bookCondition = $condResult ? $condResult['book_condition'] : 'Unknown';
?>
  <p><strong>Condition:</strong> <?= htmlspecialchars($bookCondition) ?></p>
<?php endif; ?>

<?php if ($book['format'] === 'E-Book'): 
    $pdfQuery = $conn->prepare("SELECT book_path FROM ebook WHERE book_id = ?");
    $pdfQuery->bind_param("i", $bookId);
    $pdfQuery->execute();
    $pdfResult = $pdfQuery->get_result()->fetch_assoc();
    $pdfPath = $pdfResult ? $pdfResult['book_path'] : 'Not uploaded';
?>
  <p><strong>PDF File:</strong> <?= htmlspecialchars($pdfPath) ?></p>
<?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
