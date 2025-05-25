<?php
require_once('../../../utilities/config.php');

// Function to add a book to wishlist
function addToWishlist($book_id, $user_id) {
    global $conn;
    
    // Check if the book is already in the wishlist
    $check_query = "SELECT * FROM wishlist WHERE book_id = ? AND user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $book_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return array(
            'success' => false,
            'message' => 'Book is already in your wishlist'
        );
    }
    
    // Add book to wishlist
    $insert_query = "INSERT INTO wishlist (book_id, user_id, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ii", $book_id, $user_id);
    
    if ($stmt->execute()) {
        return array(
            'success' => true,
            'message' => 'Book added to wishlist successfully'
        );
    } else {
        return array(
            'success' => false,
            'message' => 'Error adding book to wishlist: ' . $conn->error
        );
    }
}

// Function to remove a book from wishlist
function removeFromWishlist($book_id, $user_id) {
    global $conn;
    
    $delete_query = "DELETE FROM wishlist WHERE book_id = ? AND user_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $book_id, $user_id);
    
    if ($stmt->execute()) {
        return array(
            'success' => true,
            'message' => 'Book removed from wishlist successfully'
        );
    } else {
        return array(
            'success' => false,
            'message' => 'Error removing book from wishlist: ' . $conn->error
        );
    }
}

// Function to check if a book is in wishlist
function isInWishlist($book_id, $user_id) {
    global $conn;
    
    $check_query = "SELECT * FROM wishlist WHERE book_id = ? AND user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $book_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

// Function to get user's wishlist
function getUserWishlist($user_id) {
    global $conn;
    
    $query = "SELECT w.*, b.title, b.author, b.cover_image 
              FROM wishlist w 
              JOIN books b ON w.book_id = b.book_id 
              WHERE w.user_id = ? 
              ORDER BY w.date_added DESC";
              
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
    $userQuery = "SELECT id FROM users WHERE username = ?";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param("s", $username);
    $userStmt->execute();
    $userId = $userStmt->get_result()->fetch_assoc()['id'];
    return $userId;
}

?>