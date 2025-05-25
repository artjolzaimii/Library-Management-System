<?php 
require_once("../utilities/config.php");
session_start();
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
          <h5 class="card-header"><i class="bx bx-library"></i> Books Management</h5>
            
          <div class="card-body">
            <div class="col mb-12 d-flex justify-content-end">
              <button class="btn btn-primary" onclick="window.location.href='addBook.php'">
                <i class="bx bx-book-add"></i> Add New Book
              </button>
            </div>
            <!-- Control book by format -->
            <div class="col-xl-12">
              <div class="nav-align-top mb-4">
                <?php
                $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'For Sale';
                $formats = ['For Sale' => 'for-sale', 'For Borrow' => 'for-borrow', 'E-Book' => 'ebooks'];
                $tabIcons = [
                  'For Sale' => 'bx bx-cart',
                  'For Borrow' => 'bx bx-book-reader',
                  'E-Book' => 'bxs-file-pdf'
                ];
                ?>
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                  <?php 
                  $perPage = 5;
                  foreach ($formats as $formatName => $tabId): 
                    $pageParam = "page_" . strtolower(str_replace(' ', '_', $tabId));
                    $currentPage = isset($_GET[$pageParam]) && is_numeric($_GET[$pageParam]) ? (int)$_GET[$pageParam] : 1;
                    $currentPage = max(1, $currentPage);
                  ?>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link <?= $activeTab == $formatName ? 'active' : '' ?>"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#<?= $tabId ?>"
                        aria-controls="<?= $tabId ?>"
                        aria-selected="<?= $activeTab == $formatName ? 'true' : 'false' ?>"
                        onclick="window.location.href='bookManagement.php?tab=<?= urlencode($formatName) ?>&<?= $pageParam ?>=1';"
                      >
                        <i class="tf-icons <?= $tabIcons[$formatName] ?>"></i> <?= $formatName ?>
                      </button>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                  <?php
                  foreach ($formats as $formatName => $tabId):
                    $pageParam = "page_" . strtolower(str_replace(' ', '_', $tabId));
                    $currentPage = isset($_GET[$pageParam]) && is_numeric($_GET[$pageParam]) ? (int)$_GET[$pageParam] : 1;
                    $currentPage = max(1, $currentPage); // Ensure page is at least 1
                    $startPos = ($currentPage - 1) * $perPage;
                  ?>
                    <div class="tab-pane fade <?php echo $formatName == $activeTab ? 'active show' : '' ?>" id="<?php echo $tabId; ?>" role="tabpanel">
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
                            // Count total books for pagination
                            $countQuery = "SELECT COUNT(*) as total FROM `book` WHERE `format` = ?";
                            $countStmt = $conn->prepare($countQuery);
                            $countStmt->bind_param("s", $formatName);
                            $countStmt->execute();
                            $countResult = $countStmt->get_result();
                            $totalBooks = $countResult->fetch_assoc()['total'];
                            $nrPages = ceil($totalBooks / $perPage);

                            // Adjust currentPage to not exceed nrPages
                            $currentPage = min($currentPage, max(1, $nrPages));
                            $startPos = ($currentPage - 1) * $perPage;

                            // Fetch books for current page
                            $queryPerPage = "SELECT `book_id`, `isbn`, `title` FROM `book` WHERE `format` = ? LIMIT ?, ?";
                            $stmt = $conn->prepare($queryPerPage);
                            $stmt->bind_param("sii", $formatName, $startPos, $perPage);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()):
                              echo "<tr>
                                      <td>{$row['isbn']}</td>
                                      <td>{$row['title']}</td>";

                              // Authors
                              echo "<td><ul class='list-unstyled users-list m-0 avatar-group d-flex align-items-center'>";
                              $a_query = "SELECT author.full_name , image_path FROM author 
                                          INNER JOIN book_author ON book_author.author_id = author.author_id 
                                          WHERE book_author.book_id = ?";
                              $a_stmt = $conn->prepare($a_query);
                              $a_stmt->bind_param("i", $row['book_id']);
                              $a_stmt->execute();
                              $a_result = $a_stmt->get_result();
                              while ($author = $a_result->fetch_assoc()) {
                                echo "<li class='avatar avatar-xs pull-up'>
                                        <a href='#'
                                           data-bs-toggle='tooltip'
                                           data-bs-html='true'
                                           data-bs-placement='top'
                                           title=\"" . htmlspecialchars('<i class=\'bx bx-user\'></i> <span>' . $author['full_name'] . '</span>') . "\">
                                          <img src='../uploads/authors/" . htmlspecialchars($author['image_path']) . "' alt='Avatar' class='rounded-circle'>
                                        </a>
                                      </li>";
                              }
                              echo "</ul></td>";

                              // Genres
                              echo "<td>";
                              $g_query = "SELECT genres.name FROM genres 
                                          INNER JOIN book_genre ON book_genre.genre_id = genres.id 
                                          WHERE book_genre.book_id = ?";
                              $g_stmt = $conn->prepare($g_query);
                              $g_stmt->bind_param("i", $row['book_id']);
                              $g_stmt->execute();
                              $g_result = $g_stmt->get_result();
                              while ($genre = $g_result->fetch_assoc()) {
                                echo "<span class='badge bg-label-primary me-1'>{$genre['name']}</span>";
                              }
                              echo "</td>";

                              // Format
                              echo "<td><span class='badge rounded-pill bg-label-primary'>{$formatName}</span></td>";

                              // Actions
                              echo "<td>
                                    <button type='button' class='btn rounded-pill btn-icon btn-outline-primary' data-bs-toggle='modal' data-bs-target='#viewBookModal{$row['book_id']}'>
                                      <span class='bx bx-show'></span>
                                    </button>
                                    <button type='button' class='btn rounded-pill btn-icon btn-outline-warning' data-bs-toggle='modal' data-bs-target='#editBookModal{$row['book_id']}'>
                                      <i class='bx bx-pencil'></i>
                                    </button>
                                    <a href='deleteBook.php?id={$row['book_id']}' class='btn rounded-pill btn-icon btn-outline-danger' onclick=\"return confirm('Are you sure you want to delete this book?');\">
                                      <i class='bx bx-trash'></i>
                                    </a>
                                  </td>
                                </tr>";

                              include('viewBook.php');
                              include('editBook.php');
                            endwhile;
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!-- Pagination -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <div class="demo-inline-spacing">
                              <nav aria-label="Page navigation">
                                <ul class="pagination">
                                  <li class="page-item first">
                                    <a class="page-link" href="bookManagement.php?tab=<?= urlencode($formatName) ?>&<?= $pageParam ?>=1"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                  </li>
                                  <li class="page-item prev">
                                    <a class="page-link" href="bookManagement.php?tab=<?= urlencode($formatName) ?>&<?= $pageParam ?>=<?= max(1, $currentPage - 1) ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
                                  </li>
                                  <?php 
                                  for ($i = 1; $i <= $nrPages; $i++) {
                                    $active = ($currentPage == $i) ? "active" : "";
                                    echo "<li class='page-item $active'>
                                            <a class='page-link' href='bookManagement.php?tab=" . urlencode($formatName) . "&$pageParam=$i'>$i</a>
                                          </li>"; 
                                  }
                                  ?>
                                  <li class="page-item next">
                                    <a class="page-link" href="bookManagement.php?tab=<?= urlencode($formatName) ?>&<?= $pageParam ?>=<?= min($nrPages, $currentPage + 1) ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
                                  </li>
                                  <li class="page-item last">
                                    <a class="page-link" href="bookManagement.php?tab=<?= urlencode($formatName) ?>&<?= $pageParam ?>=<?= $nrPages ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                  </li>
                                </ul>
                              </nav>
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

<script>
  document.getElementById('searchBar').addEventListener("keyup", () => {
    filterTables();
  });

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
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
</script>

</body>
</html>