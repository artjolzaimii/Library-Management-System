<?php 
    require_once('../utilities/config.php');
    $bookId=$_POST['book_id'];
    $format=$_POST['format'];
    $inventory=$_POST['inventory'];
    
    if($format=='For Sale'){
        $query="UPDATE `sale_book` set inventory='$inventory' WHERE `book_id`='$bookId';";
    }
    else if($format=='For Borrow'){
        $query="UPDATE `borrow_book` set inventory='$inventory' WHERE `book_id`='$bookId';";
    }
    
    $result=mysqli_query($conn, $query);
    
    if($conn->affected_rows==0){
        echo "Error while updating inventory!";
        exit;
    }
    else{
        header("Location: stockManagement.php");
    }
?>