<?php
require_once("../utilities/config.php");

$book_id = $row['book_id'];

$book_query = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
$book_query->bind_param("i", $book_id);
$book_query->execute();
$book_result = $book_query->get_result();
$book = $book_result->fetch_assoc();

$price = $inventory = $condition = $ebook_path = "";
$format = $book['format'];

$current_price = $current_inventory = $borrow_inventory = '';

if ($format === 'For Sale') {
    $res = $conn->query("SELECT * FROM sale_book WHERE book_id = $book_id");
    if ($rowx = $res->fetch_assoc()) {
        $current_price = $rowx['price'];
        $current_inventory = $rowx['inventory'];
    }
} elseif ($format === 'For Borrow') {
    $res = $conn->query("SELECT * FROM borrow_book WHERE book_id = $book_id");
    if ($rowx = $res->fetch_assoc()) {
        $borrow_inventory = $rowx['inventory'];
        $condition = $rowx['book_condition'];
    }
} elseif ($format === 'E-Book') {
    $res = $conn->query("SELECT * FROM ebook WHERE book_id = $book_id");
    if ($rowx = $res->fetch_assoc()) {
        $ebook_path = $rowx['book_path'];
    }
}
?>

<!-- Modal HTML -->
<div class="modal fade" id="editBookModal<?= $book_id ?>" tabindex="-1" aria-labelledby="editBookModalLabel<?= $book_id ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="update-book.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="book_id" value="<?= $book_id ?>">

          <!-- General Fields -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">ISBN</label>
              <input type="text" class="form-control" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($book['title']) ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Publication Year</label>
              <input type="number" class="form-control" name="publication_year" value="<?= $book['publication_year'] ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Publisher</label>
              <input type="text" class="form-control" name="publisher" value="<?= htmlspecialchars($book['publisher']) ?>">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Language</label>
              <input type="text" class="form-control" name="language" value="<?= htmlspecialchars($book['language']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Number of Pages</label>
              <input type="number" class="form-control" name="nr_pages" value="<?= $book['nr_pages'] ?>">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($book['description']) ?></textarea>
          </div>

          <!-- Format Selection -->
          <div class="mb-3">
            <label class="form-label">Format</label>
            <select name="format" id="format<?= $book_id ?>" class="form-select" onchange="toggleEditFields<?= $book_id ?>(this.value)">
              <option value="For Sale" <?= $format === 'For Sale' ? 'selected' : '' ?>>For Sale</option>
              <option value="For Borrow" <?= $format === 'For Borrow' ? 'selected' : '' ?>>For Borrow</option>
              <option value="E-Book" <?= $format === 'E-Book' ? 'selected' : '' ?>>E-Book</option>
            </select>
          </div>

          <!-- Sale Fields -->
          <div id="saleFields<?= $book_id ?>" class="row mb-3">
            <div class="col-md-6">
              <label for="inventory_sale<?= $book_id ?>">Inventory</label>
              <input type="number" name="inventory_sale" class="form-control" value="<?= htmlspecialchars($current_inventory) ?>" min="0">
            </div>
            <div class="col-md-6">
              <label for="price<?= $book_id ?>">Price (€)</label>
              <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($current_price) ?>" min="0" step="0.01">
            </div>
          </div>

          <!-- Borrow Fields -->
          <div id="borrowFields<?= $book_id ?>" class="row mb-3">
            <div class="col-md-6">
              <label for="inventory_borrow<?= $book_id ?>">Inventory</label>
              <input type="number" name="inventory_borrow" class="form-control" value="<?= htmlspecialchars($borrow_inventory) ?>" min="0">
            </div>
            <div class="col-md-6">
              <label for="book_condition<?= $book_id ?>" class="form-label">Condition</label>
              <select name="book_condition" class="form-select">
                <option value="" disabled>Select book condition</option>
                <option value="New" <?= $condition === 'New' ? 'selected' : '' ?>>New</option>
                <option value="Very Good" <?= $condition === 'Very Good' ? 'selected' : '' ?>>Very Good</option>
                <option value="Good" <?= $condition === 'Good' ? 'selected' : '' ?>>Good</option>
                <option value="Poor" <?= $condition === 'Poor' ? 'selected' : '' ?>>Poor</option>
                <option value="Damaged" <?= $condition === 'Damaged' ? 'selected' : '' ?>>Damaged</option>
              </select>
            </div>
          </div>

          <!-- Ebook Fields -->
          <div id="ebookFields<?= $book_id ?>" class="mb-3">
            <label class="form-label">Replace PDF</label>
            <input type="file" class="form-control" name="bookPdf">
            <?php if ($ebook_path): ?>
              <small class="text-muted">Current: <?= htmlspecialchars($ebook_path) ?></small>
            <?php endif; ?>
          </div>

          <!-- Cover Image -->
          <div class="mb-3">
            <label class="form-label">Cover Image</label>
            <input type="file" class="form-control" name="imagePath">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function toggleEditFields<?= $book_id ?>(format) {
  document.getElementById('saleFields<?= $book_id ?>').style.display = (format === 'For Sale') ? 'flex' : 'none';
  document.getElementById('borrowFields<?= $book_id ?>').style.display = (format === 'For Borrow') ? 'flex' : 'none';
  document.getElementById('ebookFields<?= $book_id ?>').style.display = (format === 'E-Book') ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', function () {
  toggleEditFields<?= $book_id ?>('<?= $format ?>');
});
</script>
