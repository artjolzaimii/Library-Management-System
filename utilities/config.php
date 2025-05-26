<?php
$host='localhost';
$username='root';
$password='';
$db='bookstore_db';
$port='3307';

$conn=new mysqli($host,$username,$password,$db,$port);

if($conn->connect_error){
    echo("Connection failed:".$conn->connect_error);
}
?>