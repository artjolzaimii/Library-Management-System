<?php
$host='localhost';
$username='root';
$password='NikolaBarcelona2023$';
$db='library';

$conn=new mysqli($host,$username,$password,$db);
if($conn->connect_error){
    echo("Connection failed:".$conn->connect_error);
}
?>