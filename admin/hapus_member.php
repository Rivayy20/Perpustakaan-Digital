<?php 
include 'conn.php';

$nik = $_GET['nik'];
$sql = "DELETE FROM tb_member WHERE nik = '$nik'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus')</script>";
    echo "<script>window.location.replace('tb_member.php')</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>