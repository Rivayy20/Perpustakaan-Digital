<?php 
include 'conn.php';

$id_transaksi = $_GET['id_transaksi'];
$sql = "UPDATE tb_transaksi SET status='diambil' WHERE id_transaksi='$id_transaksi'";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Record updated successfully'); window.location.href = 'tb_transaksi.php';</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>