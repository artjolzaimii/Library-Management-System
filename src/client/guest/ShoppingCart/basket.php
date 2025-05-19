<div class="menu-cart">
    <div class="cart-box">
        <?php
            require_once("shoppingCartFunctionalities.php");
            require_once(__DIR__."/../../../../utilities/config.php");
            
            
            $cartId = getShopCartId($conn);
            $query = "
                SELECT book.book_id,isbn,title, sale_book.price, image_path, quantity
                FROM cart_book INNER JOIN book ON cart_book.book_id=book.book_id
                INNER JOIN sale_book ON book.book_id=sale_book.book_id 
                WHERE cart_book.cart_id=?
            ";
            
            $stm = $conn->prepare($query);
            $stm->bind_param("i", $cartId);
            $stm->execute();
            
            $result = $stm->get_result();
            
            $totalPrice = 0;
            $cnt=0;
        ?>
        <!-- Make this div scrollable -->
        <div class="cart-items-list" style="max-height: 250px; overflow-y: auto;">
            <?php
            while($book = mysqli_fetch_assoc($result)){
                echo '
                    <ul>
                        <li>
                            <img src="../../../uploads/images/'.$book['image_path'].'" alt="image">
                            <div class="cart-product">
                                <div class="cart-ctx">
                                    <a href="bookDetails.php?isbn='.$book['isbn'].'">'.$book['title'].'</a>
                                    <span>'.$book['quantity']." x ".$book['price'].' All</span>
                                </div>
                                <a href="shopList.php?bookId='.$book['book_id'].'"><i class="fa-solid fa-xmark"></i></a>
                            </div>
                        </li>
                    </ul>
                ';
                $totalPrice += $book['price']*$book['quantity'];
                $cnt++;
            }
            ?>
        </div>
        <?php 
            if(isset($_GET['bookId'])){
                $bookId=mysqli_real_escape_string($conn, $_GET['bookId']);
                deleteBookFromBasket($conn,$bookId);
            }
        ?>
        
        <div class="shopping-items">
            <span>Total :</span>
            <span><?php echo $totalPrice." All" ?></span>
        </div>
        
        <div class="cart-button mb-4">
            <a href="shopCart.php" class="theme-btn">
                View Cart
            </a>
        </div>
    </div>
    <ul class="header-icon">
        <li>
            <a href="#"><i class="fa-regular fa-bag-shopping"></i><span class="number"><?php echo $cnt;?></span></a>
        </li>
    </ul>
</li>
</div>