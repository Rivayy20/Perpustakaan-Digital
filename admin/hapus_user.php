<?php 
include 'conn.php'; 

$id_user = $_GET['id_user'];
$sql = "DELETE FROM tb_user WHERE id_user = '$id_user'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus')</script>";
    echo "<script>window.location.replace('tb_user.php')</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>