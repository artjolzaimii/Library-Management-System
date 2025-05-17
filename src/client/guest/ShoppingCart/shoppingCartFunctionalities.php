<?php 
    function addBookToBasket($conn,$bookId,$quantity){
        $shopCartId=getShopCartId($conn);
        
        if ($shopCartId === null) {
            die("Shopping cart not found!");
        }     
        $query=
        "
            INSERT INTO cart_book(`cart_id`,`book_id`,`quantity`)
            VALUES (?,?,?);
        ";
        
        $stm=$conn->prepare($query);
        
        $stm->bind_param("iii",$shopCartId,$bookId,$quantity);
        $stm->execute();
        
        
        if($stm->affected_rows==1){
            echo '<script>window.location.href = "shopList.php";</script>';
            exit();
        }
        
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
            "
                SELECT shopping_cart.cart_id
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