<?php
$host = 'localhost';     // Server name
$username = 'root';      // Database username
$password = '';          // Database password (empty for XAMPP)
$database = 'garments'; // Database name
$conn = mysqli_connect('localhost','root','','garments');
if (!$conn) {
    echo "cannot connect to database";
    die();} 
?>