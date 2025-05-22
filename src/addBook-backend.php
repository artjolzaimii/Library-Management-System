<?php 
    session_start();
    require_once("../utilities/config.php");
    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    // Function to fix user input
    function filterInput($conn, $input) {
        return mysqli_real_escape_string($conn, trim($input));
    }
    
    // Validate required fields
    $requiredFields = ['isbn', 'title', 'publication_year', 'publisher', 'nrPages', 'language', 'description', 'format'];
    $errors = [];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }
    
    if (!empty($_POST['publication_year']) && !ctype_digit($_POST['publication_year'])) {
        $errors['publication_year'] = "Publication year must be a number.";
    }
    
    if (!empty($_POST['nrPages']) && !ctype_digit($_POST['nrPages'])) {
        $errors['nrPages'] = "Number of pages must be a number.";
    }
    
    //Check for some injection
    $isbn = filterInput($conn, $_POST['isbn']);
    $title = filterInput($conn, $_POST['title']);
    $publicationYear = filterInput($conn, $_POST['publication_year']);
    $publisher = filterInput($conn, $_POST['publisher']);
    $nrPages = filterInput($conn, $_POST['nrPages']);
    $language = filterInput($conn, $_POST['language']);
    $description = filterInput($conn, $_POST['description']);
    $format = filterInput($conn, $_POST['format']);
    $genres = isset($_POST['genres']) ? array_map('htmlspecialchars', $_POST['genres']) : [];
    $authors = isset($_POST['authors']) ? array_map('htmlspecialchars', $_POST['authors']) : [];
    
    // Validate format-dependent fields
    if ($format === 'For Sale') {
        if (!isset($_POST['inventorySale']) || trim($_POST['inventorySale']) === "" || !ctype_digit($_POST['inventorySale'])) {
            $errors['inventory'] = "Inventory must be a valid number.";
        } else {
            $inventory = filterInput($conn, $_POST['inventorySale']);
        }
    
        if (!isset($_POST['price']) || !is_numeric($_POST['price'])) {
            $errors['price'] = "Price must be a valid number.";
        } else {
            $price = filterInput($conn, $_POST['price']);
        }
    } else if ($format === 'For Borrow') {
        if (!isset($_POST['inventoryBorrow']) || !ctype_digit($_POST['inventoryBorrow'])) {
            $errors['inventory'] = "Inventory must be a number.";
        } else {
            $inventory = filterInput($conn, $_POST['inventoryBorrow']);
        }
    
        if (empty($_POST['condition'])) {
            $errors['condition'] = "Condition is required.";
        } else {
            $condition = filterInput($conn, $_POST['condition']);
        }
    } else if ($format === 'E-Book') {
        if (isset($_FILES['bookPdf']) && $_FILES['bookPdf']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['application/pdf'];
    
            if (!in_array($_FILES['bookPdf']['type'], $allowedTypes)) {
                $errors['bookPdf'] = "Only PDF format is allowed.";
            } else {
                $pdfTmp = $_FILES['bookPdf']['tmp_name'];
                $pdfName = uniqid() . "_" . basename($_FILES['bookPdf']['name']);
                move_uploaded_file($pdfTmp, "../uploads/eBooks/" . $pdfName);
            }
        }
    }
    
    // Validate and move uploaded image
    if (isset($_FILES['imagePath']) && $_FILES['imagePath']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
        if (!in_array($_FILES['imagePath']['type'], $allowedTypes)) {
            $errors['imagePath'] = "Only JPEG, PNG, and GIF images are allowed.";
        } else {
            $imgTmp = $_FILES['imagePath']['tmp_name'];
            $imgName = uniqid() . "_" . basename($_FILES['imagePath']['name']);
            move_uploaded_file($imgTmp, "../uploads/images/" . $imgName);
        }
    }
    
    // Validate numeric fields
    if (!empty($_POST['publication_year']) && (!ctype_digit($_POST['publication_year']) || intval($_POST['publication_year']) < 0)) {
        $errors['publication_year'] = "Publication year must be a positive number.";
    }
    if (!empty($_POST['nrPages']) && (!ctype_digit($_POST['nrPages']) || intval($_POST['nrPages']) <= 0)) {
        $errors['nrPages'] = "Number of pages must be a positive number.";
    }
    
    
    // Check for duplicate ISBN
    if (!empty($isbn)) {
        $isbnCheckQuery = "SELECT COUNT(*) FROM `book` WHERE `isbn` = ?";
        $isbnStmt = $conn->prepare($isbnCheckQuery);
        $isbnStmt->bind_param('s', $isbn);
        $isbnStmt->execute();
        $isbnStmt->bind_result($isbnCount);
        $isbnStmt->fetch();
        $isbnStmt->close();
        if ($isbnCount > 0) {
            $errors['isbn'] = "A book with this ISBN already exists.";
        }
    }
    
    // Stop process if validation fails
    if (!empty($errors)) {
        $_SESSION['add_book_errors'] = $errors;
        $_SESSION['add_book_old'] = $_POST;
        header("Location: addBook.php");
        exit;
    }
    
    // Insert into `book` table
    $query = "INSERT INTO `book` (`isbn`, `title`, `publication_year`, `publisher`, `language`, `nr_pages`, `description`, `format`, `image_path`) 
              VALUES ('$isbn', '$title', '$publicationYear', '$publisher', '$language', '$nrPages', '$description', '$format', '$imgName')";
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Book insertion failed: " . mysqli_error($conn));
    }
    
    $bookId = mysqli_insert_id($conn);
    
    //Insert into author table
    foreach ($authors as $author) {
        $query = "INSERT INTO `book_author`(`book_id`, `author_id`) VALUES (?, ?)";
        $stm = $conn->prepare($query);
        if (!$stm) {
            die("Statement preparation failed: " . $conn->error);
        }
        $stm->bind_param('ii', $bookId, $author); // Bind both variables in one call
        $stm->execute();
        if ($stm->affected_rows === 0) {
            die("Book-author insertion failed: " . $conn->error);
        }
        $stm->close(); // Always close statements after execution
    }
    
    foreach($genres as $genre){
        $query="INSERT INTO `book_genre`(`book_id`,`genre_id`) VALUES (?,?)";
        $stm=$conn-> prepare($query);
        
        if (!$stm) {
            die("Statement preparation failed: " . $conn->error);
        }
        
        $stm->bind_param('ii',$bookId,$genre);
        $stm->execute();
        
        if ($stm->affected_rows === 0) {
            die("Book-author insertion failed: " . $conn->error);
        }
        $stm->close();
    }
    // Insert into format-specific tables
    if ($format === 'For Sale') {
        $query = "INSERT INTO `sale_book` (`book_id`, `inventory`, `price`) VALUES ('$bookId', '$inventory', '$price')";
    } elseif ($format === 'For Borrow') {
        $query = "INSERT INTO `borrow_book` (`book_id`, `inventory`, `book_condition`) VALUES ('$bookId', '$inventory', '$condition')";
    } elseif ($format === 'E-Book') {
        $query = "INSERT INTO `ebook` (`book_id`, `book_path`) VALUES ('$bookId', '$pdfName')";
    }
    
    if (!($res=mysqli_query($conn, $query))) {
        die("Format-specific insert failed: " . mysqli_error($conn));
    }
    else{
        header("Location: addBook.php");
    }    
    
    //If successful
    if ($result) {
        $_SESSION['add_book_success'] = "Book added successfully!";
        header("Location: addBook.php");
        exit;
    } else {
        $_SESSION['add_book_errors'] = ["db" => "Book insertion failed: " . mysqli_error($conn)];
        $_SESSION['add_book_old'] = $_POST;
        header("Location: addBook.php");
        exit;
    }
?>