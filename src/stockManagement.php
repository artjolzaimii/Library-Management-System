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
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>
<div class="layout-container">
  <?php include('../utilities/menu.php'); ?>

  <div class="layout-page">
    <div class="content-wrapper">
      <?php include('../utilities/navbar.php'); ?>

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Books Management /</span> Stock Management
        </h4>

        <div class="card mb-4">
          <h5 class="card-header"><i class="bx bx-library"></i> Stock Management</h5>

          <div class="col-xl-12">
            <div class="nav-align-top mb-4">
              <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#viewAll" aria-controls="viewAll" aria-selected="true">
                  <i class='bx bxs-package'></i> View All
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#viewLow" aria-controls="viewLow" aria-selected="false">
                    <i class="tf-icons bx bx-book-reader"></i> View Low Stock
                  </button>
                </li>
              </ul>
              
              <div class="tab-content">
                <div class="tab-pane fade show active" id="viewAll" role="tabpanel">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ISBN</th>
                          <th>Title</th>
                          <th>Authors</th>
                          <th>Genres</th>
                          <th>Format</th>
                          <th>Inventory</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <?php
                          $query = "SELECT 
                                        book.book_id, 
                                        book.isbn, 
                                        book.title, 
                                        book.format, 
                                        sale_book.inventory AS sale_inventory, 
                                        borrow_book.inventory AS borrow_inventory
                                    FROM 
                                        book
                                    LEFT JOIN 
                                        sale_book ON book.book_id = sale_book.book_id
                                    LEFT JOIN 
                                        borrow_book ON book.book_id = borrow_book.book_id
                                    WHERE
                                        book.format='For Sale' OR book.format='For Borrow'
                                    ;";
                          $result = mysqli_query($conn, $query);

                          while ($row = mysqli_fetch_array($result)):
                            if (($row['sale_inventory'] <= 5 && $row['format']=='For Sale')|| ($row['borrow_inventory'] <= 2 && $row['format']=='For Borrow')) { 
                                echo "<tr class='table-danger'>"; 
                            } 
                            else if ($row['sale_inventory'] <= 10  && $row['format']=='For Sale') { 
                                echo "<tr class='table-warning'>"; 
                            } 
                            else { 
                                echo "<tr>"; 
                            }
                            
                            echo "<td>{$row['isbn']}</td>
                                    <td>{$row['title']}</td>";

                            // Authors
                            echo "<td><ul class='list-unstyled users-list m-0 avatar-group d-flex align-items-center'>";
                            $a_query = "SELECT author.full_name FROM author 
                                        INNER JOIN book_author ON book_author.author_id = author.author_id 
                                        WHERE book_author.book_id = '{$row['book_id']}'";
                            $a_result = mysqli_query($conn, $a_query);
                            while ($author = mysqli_fetch_assoc($a_result)) {
                              echo "<li class='avatar avatar-xs pull-up'>
                                      <a data-bs-toggle='tooltip' data-bs-html='true' 
                                         data-bs-original-title=\"<i class='bx bx-user'></i> <span>{$author['full_name']}</span>\">
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

                            // Inventory
                            if ($row['format'] == 'For Sale') {
                                echo "<td><span class='badge rounded-pill bg-label-primary'>For Sale</span></td>";
                                echo "<td><span class='badge rounded-pill bg-label-info'>" . ($row['sale_inventory'] ?? 0) . "</span></td>";
                            } else if ($row['format'] == 'For Borrow') {
                                echo "<td><span class='badge rounded-pill bg-label-secondary'>For Borrow</span></td>";
                                echo "<td><span class='badge rounded-pill bg-label-info'>" . ($row['borrow_inventory'] ?? 0) . "</span></td>";
                            }
                            

                            // Actions
                            echo "<td>
                                    <button type=\"button\" class=\"btn btn-outline-primary\"><i class=\"bx bx-layer-plus\"></i>Restock</button>
                                  </td>
                                  </tr>";
                          endwhile;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-pane fade" id="viewLow" role="tabpanel">
                  <!-- You can implement logic to display books with low stock here -->
                  <p class="text-muted">Low stock books will be shown here.</p>
                </div>
              </div> 
            </div> <!-- End nav-align-top -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
  }
  
  
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>

</body>
</html>
