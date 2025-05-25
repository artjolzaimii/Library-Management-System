<?php
// filepath: c:\xampp\htdocs\Online-Library-Management-System\src\client\guest\ShoppingCart\basket.php
require_once("shoppingCartFunctionalities.php");
require_once("../../../utilities/config.php");

$cartId = getShopCartId($conn);
$query = "SELECT book.book_id, isbn, title, sale_book.price, image_path, quantity
    FROM cart_book 
    INNER JOIN book ON cart_book.book_id = book.book_id
    INNER JOIN sale_book ON book.book_id = sale_book.book_id 
    WHERE cart_book.cart_id = ?
";

$stm = $conn->prepare($query);
$stm->bind_param("i", $cartId);
$stm->execute();
$result = $stm->get_result();

$totalPrice = 0;
$cnt = 0;
?>
<div class="menu-cart">
    <div class="cart-box">
        <!-- Make this div scrollable -->
        <div class="cart-items-list" style="max-height: 250px; overflow-y: auto;">
            <?php while ($book = $result->fetch_assoc()): ?>
                <ul>
                    <li>
                        <img src="../../../uploads/images/<?php echo htmlspecialchars($book['image_path']); ?>" alt="image">
                        <div class="cart-product">
                            <div class="cart-ctx">
                                <a href="bookDetails.php?isbn=<?php echo urlencode($book['isbn']); ?>">
                                    <?php echo htmlspecialchars($book['title']); ?>
                                </a>
                                <span><?php echo htmlspecialchars($book['quantity']) . " x " . htmlspecialchars($book['price']); ?> All</span>
                            </div>
                            <a href="shopList.php?bookId=<?php echo $book['book_id']; ?>"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                    </li>
                </ul>
                <?php
                $totalPrice += $book['price'] * $book['quantity'];
                $cnt++;
            endwhile;
            ?>
        </div>
        <?php 
        // Handle book removal securely (should be POST in production)
        if (isset($_GET['bookId'])) {
            $bookId = mysqli_real_escape_string($conn, $_GET['bookId']);
            deleteBookFromBasket($conn, $bookId);
            // Redirect to avoid resubmission on refresh
            //header("Location: basket.php");
            exit;
        }
        ?>
        <div class="shopping-items">
            <span>Total :</span>
            <span><?php echo $totalPrice . " All"; ?></span>
        </div>
        <div class="cart-button mb-4">
            <a href="shopCart.php" class="theme-btn">
                View Cart
            </a>
        </div>
    </div>
    <ul class="header-icon">
        <li>
            <a href="#"><i class="fa-regular fa-bag-shopping"></i><span class="number"><?php echo $cnt; ?></span></a>
        </li>
    </ul>
</div>