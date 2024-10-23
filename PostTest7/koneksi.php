<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "crud_makanan"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>