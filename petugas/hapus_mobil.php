<?php 
include 'conn.php';

$nopol = $_GET['nopol'];

$query = "DELETE FROM tb_mobil WHERE nopol='$nopol'";
if (mysqli_query($conn, $query)) {
    echo "<script>alert('Mobil berhasil dihapus'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus mobil');</script>";
}
?>