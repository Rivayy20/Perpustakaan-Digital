<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION) {
    if ($_SESSION['role'] != 'petugas') {
        header('location: ../index.php');
        exit();
    }
} else {
    header('location: ../index.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_mobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>