<?php 
    require_once("../utilities/config.php");
    
    $isbn = htmlspecialchars(trim($_POST['isbn']));
    $title = htmlspecialchars(trim($_POST['title']));
    $genres = isset($_POST['genres']) ? array_map('htmlspecialchars', $_POST['genres']) : [];
    $authors = isset($_POST['authors']) ? array_map('htmlspecialchars', $_POST['authors']) : [];
    $publicationYear = htmlspecialchars(trim($_POST['publication_year']));
    $publisher = htmlspecialchars(trim($_POST['publisher']));
    $nrPages = htmlspecialchars(trim($_POST['nrPages']));
    $language = htmlspecialchars(trim($_POST['language']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = htmlspecialchars(trim($_POST['price']));
    $inventory = htmlspecialchars(trim($_POST['inventory']));
    $format = htmlspecialchars(trim($_POST['format']));
    $condition = htmlspecialchars(trim($_POST['condition']));
    $imagePath = htmlspecialchars(trim($_FILES['imagePath'])); 

    
?>