<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}   

if (!isset($_SESSION['nik'])) {
    header("Location: ../index.php");
    exit(); 
}

$nik = $_SESSION['nik'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_mobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>