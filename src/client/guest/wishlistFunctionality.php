<?php
require_once('../../../utilities/config1.php');

// Function to add a book to wishlist
function addToWishlist($book_id, $user_id) {
    global $conn;
    
    try {
        $query = "INSERT INTO wishlist (book_id, user_id) VALUES (?, ?)";
        $stm = $conn->prepare($query);
        $stm->bind_param("ii", $book_id, $user_id);
        $stm->execute();
        
        if($conn->affected_rows > 0) {
            return [
                'success' => true,
                'message' => 'Book added to wishlist successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to add book to wishlist'
            ];
        }
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => 'An error occurred while adding to wishlist'
        ];
    }
}

// Function to remove a book from wishlist
function removeFromWishlist($book_id, $user_id) {
    global $conn;
    
    try {
        $query = "DELETE FROM wishlist WHERE book_id = ? AND user_id = ?";
        $stm = $conn->prepare($query);
        $stm->bind_param("ii", $book_id, $user_id);
        $stm->execute();
        
        if($conn->affected_rows > 0) {
            return [
                'success' => true,
                'message' => 'Book removed from wishlist successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to remove book from wishlist'
            ];
        }
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => 'An error occurred while removing from wishlist'
        ];
    }
}

// Function to check if a book is in wishlist
function isInWishlist($book_id, $user_id) {
    global $conn;
    
    $query = "SELECT COUNT(*) as count FROM wishlist WHERE book_id = ? AND user_id = ?";
    $stm = $conn->prepare($query);
    $stm->bind_param("ii", $book_id, $user_id);
    $stm->execute();
    $result = $stm->get_result();
    $row = $result->fetch_assoc();
    
    return $row['count'] > 0;
}

// Function to get user's wishlist
function getUserWishlist($user_id) {
    global $conn;
    
    $query = "SELECT w.*, b.title, b.image_path, GROUP_CONCAT(a.full_name) as authors, sb.price 
              FROM wishlist w 
              JOIN book b ON w.book_id = b.book_id 
              LEFT JOIN book_author ba ON b.book_id = ba.book_id
              LEFT JOIN author a ON ba.author_id = a.author_id
              LEFT JOIN sale_book sb ON b.book_id = sb.book_id
              WHERE w.user_id = (SELECT id FROM users WHERE username = ?)
              GROUP BY w.wishlist_id, b.title, b.image_path, sb.price
              ORDER BY w.created_at DESC";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $wishlist = array();
    while ($row = $result->fetch_assoc()) {
        $wishlist[] = $row;
    }
    
    return $wishlist;
}

function getWishlistCount($user_id) {
    global $conn;

    $query = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['count'];
}

function getUserId($username) {
    global $conn;
    
    $query = "SELECT id FROM users WHERE username = ?";
    $stm = $conn->prepare($query);
    $stm->bind_param("s", $username);
    $stm->execute();
    $result = $stm->get_result();
    $row = $result->fetch_assoc();
    
    return $row ? $row['id'] : null;
}
?>