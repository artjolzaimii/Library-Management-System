<?php 
    require_once("../utilities/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="layout-container">
  <?php include('../utilities/menu.php'); ?>

  <div class="layout-page">
    <div class="content-wrapper">
      <?php include('../utilities/navbar.php'); ?>

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Book Management /</span> Add Book
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-book-add"></i> Add Book</h5>
          <div class="card-body">
          <form action="addBook-backend.php" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="isbn" class="form-label">ISBN</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-barcode"></i></span>
                  <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
                </div>
              </div>
              <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-book"></i></span>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>
              </div>
            </div>
          
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="authors" class="form-label">Authors</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <select name="authors[]" id="authors" class="form-control" multiple>
                    <option value="" disabled>Select author(s)...</option>
                    <?php 
                      $query = 'SELECT `author_id`, `full_name` FROM `author`';
                      $stm = $conn->prepare($query);
                      if ($stm) {
                        $stm->execute();
                        $stm->bind_result($author_id, $author_name);
                        while ($stm->fetch()) {
                          echo "<option value='" . htmlspecialchars($author_id) . "'>" . htmlspecialchars($author_name) . "</option>";
                        }
                        $stm->close();
                      } else {
                        echo "<option disabled>Error loading authors</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <label for="genres" class="form-label">Genres</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-category"></i></span>
                  <select name="genres[]" id="genres" class="form-control" multiple>
                    <option value="" disabled>Select genres...</option>
                    <?php 
                      
                      $query = "SELECT `id`,`name` FROM `genres`";
                      $stm = $conn->prepare($query);
                      if ($stm) {
                        $stm->execute();
                        $stm->bind_result($id ,$genre);
                        while ($stm->fetch()) {
                          echo "<option value=".htmlspecialchars($id).">".htmlspecialchars($genre)."</option>";
                        }
                      }
                      
                    ?>
                  </select>
                </div>
              </div>
            </div>
          
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="nrPages" class="form-label">Number of Pages</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-file"></i></span>
                  <input type="number" class="form-control" name="nrPages" id="nrPages" placeholder="Number of pages">
                </div>
              </div>
              <div class="col-md-4">
                <label for="publisher" class="form-label">Publisher</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                  <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
                </div>
              </div>
              <div class="col-md-4">
                <label for="publication_year" class="form-label">Publication Year</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                  <input type="number" class="form-control" name="publication_year" id="publication_year" placeholder="Year">
                </div>
              </div>
            </div>
          
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="language" class="form-label">Language</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-world"></i></span>
                  <input type="text" class="form-control" name="language" id="language" placeholder="Language">
                </div>
              </div>
            </div>
          
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-detail"></i></span>
                  <textarea class="form-control" name="description" id="description" placeholder="Description" rows="3"></textarea>
                </div>
              </div>
            </div>
          
            <div class="row mb-4">
              <div class="col-md-12">
                <label for="imagePath" class="form-label">Book Image</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-image"></i></span>
                  <input type="file" class="form-control" name="imagePath" id="imagePath">
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="format" class="form-label">Book Format</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-layer"></i></span>
                  <select name="format" id="format" class="form-control">
                    <option value="" selected disabled>Select Book Format</option>
                    <option value="For Sale">For Sale</option>
                    <option value="For Borrow">For Borrow</option>
                    <option value="E-Book">E-Book</option>
                  </select>
                </div>
              </div>
            </div>
          
                      <!-- Handling books for sale -->
          <div id="forSale" style="display: none;">
            <div class="text-center my-4 position-relative">
              <hr class="border border-dark">
              <span class="position-absolute top-50 start-50 translate-middle bg-white px-3">Book for Sale</span>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="inventorySale" class="form-label">Inventory</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-box"></i></span>
                  <input type="number" class="form-control" name="inventorySale" id="inventorySale" placeholder="Inventory" min="0">
                </div>
              </div>
              <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-dollar"></i></span>
                  <input type="number" class="form-control" name="price" id="price" placeholder="Price">
                </div>
              </div>
            </div>
          </div>
          
          <!-- Handling books for borrowing -->
          <div id="forBorrow" style="display: none;">
            <div class="text-center my-4 position-relative">
              <hr class="border border-dark">
              <span class="position-absolute top-50 start-50 translate-middle bg-white px-3">Book for Borrowing</span>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="inventoryBorrow" class="form-label">Inventory</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-box"></i></span>
                  <input type="number" class="form-control" name="inventoryBorrow" id="inventoryBorrow" placeholder="Inventory" min="0">
                </div>
              </div>
              <div class="col-md-6">
                <label for="condition" class="form-label">Condition</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bx bx-check-circle"></i></span>
                  <select name="condition" id="condition" class="form-control">
                    <option value="" disabled selected>Select book condition</option>
                    <option value="New">New</option>
                    <option value="Very Good">Very Good</option>
                    <option value="Good">Good</option>
                    <option value="Poor">Poor</option>
                    <option value="Damaged">Damaged</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Handling E-Book -->
          <div id="eBook" style="display: none;">
            <div class="text-center my-4 position-relative">
              <hr class="border border-dark">
              <span class="position-absolute top-50 start-50 translate-middle bg-white px-3">E-Book</span>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <label for="bookPdf" class="form-label">E-Book File</label>
                <div class="input-group">
                  <span class="input-group-text"><i class='bx bxs-file-pdf'></i></span>
                  <input type="file" class="form-control" name="bookPdf" id="bookPdf">
                </div>
              </div>
            </div>
          </div>

          
            <div class="text-end">
              <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save Book</button>
            </div>
          </form>

          </div>
        </div>
      </div>
    </div>
  </div>   
</div>

<script>
    let forSale=document.getElementById('forSale');
    let forBorrow=document.getElementById('forBorrow');
    let ebook=document.getElementById('eBook');
    
    let format=document.getElementById('format');
    
    format.addEventListener("change",()=>{
        if(format.value==='For Sale'){
        forSale.style.display='block';
        forBorrow.style.display='none';
        eBook.style.display='none';
      }
      else if(format.value=='For Borrow'){
        forSale.style.display='none';
        forBorrow.style.display='block';
        eBook.style.display='none';
      }
      else if(format.value==='E-Book'){
        forSale.style.display='none';
        forBorrow.style.display='none';
        eBook.style.display='block';
      }
    });
</script>
</body>
</html>
