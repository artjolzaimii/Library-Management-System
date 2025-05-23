<?php 
    function addBookToBasket($conn, $bookId, $quantity) {
        $shopCartId = getShopCartId($conn);
    
        if ($shopCartId === null) {
            die("Shopping cart not found!");
        }
    
        // Get available inventory from sale_book
        $inventoryQuery = "SELECT inventory FROM sale_book WHERE book_id = ?";
        $inventoryStmt = $conn->prepare($inventoryQuery);
        $inventoryStmt->bind_param("i", $bookId);
        $inventoryStmt->execute();
        $inventoryResult = $inventoryStmt->get_result();
    
        if ($inventoryResult->num_rows === 0) {
            echo "<div class='alert alert-danger'>Book not found in inventory.</div>";
            return;
        }
    
        $row = $inventoryResult->fetch_assoc();
        $availableInventory = (int) $row['inventory'];
    
        // Step 2: Check if the book is already in the cart
        $checkQuery = "SELECT quantity FROM cart_book WHERE cart_id = ? AND book_id = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("ii", $shopCartId, $bookId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
    
        if ($result->num_rows > 0) {
            // Book is already in the cart
            $book = $result->fetch_assoc();
            $existingQuantity = $book['quantity'];
            $newTotalQuantity = $existingQuantity + $quantity;
    
            if ($newTotalQuantity > $availableInventory) {
                echo "<div class='alert alert-warning'>Only $availableInventory items in stock. You already have $existingQuantity in your cart.</div>";
                return;
            }
    
            // Update the quantity
            $updateQuery = "UPDATE cart_book SET quantity = ? WHERE cart_id = ? AND book_id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("iii", $newTotalQuantity, $shopCartId, $bookId);
            $updateStmt->execute();
    
            if ($updateStmt->affected_rows >= 0) {
                $updateStmt->close();
                echo '<script>window.location.href = "shopList.php";</script>';
                exit();
            } else {
                echo "<div class='alert alert-danger'>Failed to update cart quantity.</div>";
            }
            $updateStmt->close();
        } else {
            if ($quantity > $availableInventory) {
                echo "<div class='alert alert-warning'>Only $availableInventory items in stock.</div>";
                return;
            }
            $insertQuery = "INSERT INTO cart_book (cart_id, book_id, quantity) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("iii", $shopCartId, $bookId, $quantity);
            $insertStmt->execute();
    
            if ($insertStmt->affected_rows === 1) {
                $insertStmt->close();
                echo '<script>window.location.href = "shopList.php";</script>';
                exit();
            } else {
                echo "<div class='alert alert-danger'>Failed to add book to cart.</div>";
            }
            $insertStmt->close();
        }
        $checkStmt->close();
        $inventoryStmt->close();
}


    function deleteBookFromBasket($conn,$bookId){
        $cartId=getShopCartId($conn);
        $query=
        "
        DELETE FROM cart_book WHERE book_id=? AND cart_id=?
        ";
        
        $stm=$conn->prepare($query);
        
        $stm->bind_param("ii",$bookId,$cartId);
        $stm->execute();
        
        if($stm->affected_rows>1){
            echo '<script>window.location.href = "shopList.php";</script>';
        }
    }
    
    function getShopCartId($conn){
        if(isset($_SESSION['username'])){
            $username=$_SESSION['username'];
            
            $query=
            "   SELECT shopping_cart.cart_id
                FROM users INNER JOIN shopping_cart ON users.id=shopping_cart.user_id
                WHERE users.username=?
            ";
            
            $stm=$conn->prepare($query);
            $stm->bind_param("s",$username);
            $stm->execute();
            $result=$stm->get_result();
            
            if($result->num_rows==1){
                return $result->fetch_assoc()['cart_id'];
            }
        }
        return null;
    }

?>