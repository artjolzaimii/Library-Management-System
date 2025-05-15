<?php
$host='localhost';
$username='root';
$password='';
$db='bookstore_db';


$conn=new mysqli($host,$username,$password,$db,);
if($conn->connect_error){
    echo("Connection failed:".$conn->connect_error);
}
?>