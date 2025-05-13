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
          <span class="text-muted fw-light">Books Management /</span> Books Management
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-library"></i>Books Management</h5>
            
          <div class="card-body">
                <div class="col mb-12 d-flex justify-content-end">
                    <button class="btn btn-primary" onclick="window.location.href='addBook.php'">
                        <i class="bx bx-book-add"></i> Add New Book
                    </button>
                </div>
                <!-- Control book by format-->
                <div class="col-xl-12">
                    
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#for-sale" aria-controls="for-sale" aria-selected="true">
                          <i class="tf-icons bx bx-cart"></i> For Sale
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#for-borrow" aria-controls="for-borrow" aria-selected="false">
                          <i class="tf-icons bx bx-book-reader"></i> For Borrow
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#ebooks" aria-controls="ebooks" aria-selected="false">
                          <i class="tf-icons bx bxs-file-pdf"></i> E-Books
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                    <?php
                        $formats = ['For Sale' => 'for-sale', 'For Borrow' => 'for-borrow', 'E-Book' => 'ebooks'];
    
                        foreach ($formats as $formatName => $tabId): ?>
                          <div class="tab-pane fade <?php echo $tabId == 'for-sale' ? 'active show' : '' ?>" id="<?php echo $tabId; ?>" role="tabpanel">
                            <div class="table-responsive text-nowrap">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>ISBN</th>
                                    <th>Title</th>
                                    <th>Authors</th>
                                    <th>Genres</th>
                                    <th>Format</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                  <?php
                                  
                                    $perPage=1;
                                    
                                    $queryForAll = "SELECT `book_id`, `isbn`, `title` FROM `book` WHERE `format` = ?";
                                    
                                    $stmt = $conn->prepare($queryForAll);
                                    $stmt->bind_param("s", $formatName);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                        
                                    $allResults = $result->num_rows;
                                    $nrPages = ceil($allResults / $perPage);
                                    
                                    if (isset($_GET['page']) && is_numeric($_GET['page']))
                                    	{
                                    		$currentPage = $_GET['page'];
                                    		
                                    		if ($currentPage > 0 && $currentPage <= $nrPages)
                                    		{
                                    			$startPos = ($currentPage -1) * $perPage;
                                    			$endPos = $startPos + $perPage; 
                                    		}
                                    		else
                                    		{
                                    			$startPos = 0;
                                    			$endPos = $perPage; 
                                    		}		
                                    	}
                                    	else
                                    	{
                                    		$startPos = 0;
                                    		$endPos = $perPage; 
                                    	}
                                          
                                    $queryPerPage = "SELECT `book_id`, `isbn`, `title` FROM `book` WHERE `format` = ? LIMIT ?, ?";                                    
                                    $stmt = $conn->prepare($queryPerPage);
                                    $stmt->bind_param("sii", $formatName,$startPos,$perPage);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    
                                    while ($row = $result->fetch_assoc()):
                                      echo "<tr>
                                              <td>{$row['isbn']}</td>
                                              <td>{$row['title']}</td>";
                        
                                      // Authors
                                      echo "<td><ul class='list-unstyled users-list m-0 avatar-group d-flex align-items-center'>";
                                      $a_query = "SELECT author.full_name FROM author 
                                                  INNER JOIN book_author ON book_author.author_id = author.author_id 
                                                  WHERE book_author.book_id = '{$row['book_id']}'";
                                      $a_result = mysqli_query($conn, $a_query);
                                      while ($author = mysqli_fetch_assoc($a_result)) {
                                        echo "<li class='avatar avatar-xs pull-up'>
                                                <a href='#' 
                                                   data-bs-toggle='tooltip' 
                                                   data-bs-html='true' 
                                                   data-bs-title=\"<i class='bx bx-user'></i> <span>{$author['full_name']}</span>\">
                                                  <img src='https://i.pinimg.com/564x/35/bc/af/35bcafd19a9b4557b972ccf96cc34a6c.jpg' alt='Avatar' class='rounded-circle'>
                                                </a>
                                              </li>";

                                      }
                                      echo "</ul></td>";
                        
                                      // Genres
                                      echo "<td>";
                                      $g_query = "SELECT genres.name FROM genres 
                                                  INNER JOIN book_genre ON book_genre.genre_id = genres.id 
                                                  WHERE book_genre.book_id = '{$row['book_id']}'";
                                      $g_result = mysqli_query($conn, $g_query);
                                      while ($genre = mysqli_fetch_assoc($g_result)) {
                                        echo "<span class='badge bg-label-primary me-1'>{$genre['name']}</span>";
                                      }
                                      echo "</td>";
                        
                                      // Format
                                      echo "<td><span class='badge rounded-pill bg-label-primary'>{$formatName}</span></td>";
                        
                                      // Actions
                                      echo "<td>
                                      <button type='button' class='btn rounded-pill btn-icon btn-outline-primary'>
                                        <span class='bx bx-show'></span>
                                      </button>
                                      <button type='button' class='btn rounded-pill btn-icon btn-outline-warning'>
                                        <span class='bx bx-pencil'></span>
                                      </button>
                                      <button type='button' class='btn rounded-pill btn-icon btn-outline-danger'>
                                        <span class='bx bx-trash'></span>
                                      </button>
                                    </td>
                                    </tr>";
                                    endwhile;
                                  ?>
                                </tbody>
                              </table>
                            </div>
                                                              <!-- Pagination-->
                            <div class="card-body">
                              <div class="row">
                                <div class="col">
                                  <div class="demo-inline-spacing">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                      <ul class="pagination">
                                  `      <li class="page-item first">
                                          <a class="page-link" href="bookManagement.php?page=1"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                        </li>
                                        <li class="page-item prev">
                                          <a class="page-link" href="bookManagement.php?page=<?php echo max(1, $currentPage - 1); ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
                                        </li>
                                        <?php 
                                          
                                          for($i=1;$i<=$nrPages;$i++){
                                            echo "<li class='page-item " . ($currentPage == $i ? "active" : "") . "'>
                                                    <a class='page-link' href='bookManagement.php?page=$i'>$i</a>
                                                  </li>"; 
                                          }
                                        ?>
                                        <li class="page-item next">
                                          <a class="page-link" href="bookManagement.php?page=<?php echo min($nrPages, $currentPage + 1); ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
                                        </li>
                                        <li class="page-item last">
                                          <a class="page-link" href="bookManagement.php?page=<?php echo $nrPages; ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                        </li>
                                      </ul>
    
                                    </nav>
                                    <!--/ Basic Pagination -->
                                  </div>
                                </div>
                              </div>
                            </div>  
                          </div>
                          
                        <?php endforeach; ?>        
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>   
</div>

<script>
    document.getElementById('searchBar').addEventListener("keyup",()=>{
        filterTables();
    })
    function filterTables() {
      const filter = document.getElementById("searchBar").value.toLowerCase();
      const allTables = document.querySelectorAll(".tab-content table");
    
      allTables.forEach(table => {
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(filter) ? '' : 'none';
        });
      });
    };
    
      document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
        })
      });
</script>

</body>
</html>