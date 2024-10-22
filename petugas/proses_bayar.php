<?php
session_start(); // Mulai session untuk menggunakan session
include 'conn.php'; // Pastikan koneksi ke database sudah diatur

if (isset($_GET['id_bayar'])) {
    $id_bayar = $_GET['id_bayar'];

    // Update tgl_bayar dan status di tb_bayar
    $query = "UPDATE tb_bayar SET tgl_bayar = NOW(), status = 'lunas' WHERE id_bayar = ?";
    
    // Persiapkan statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $id_bayar); // Bind parameter
        $stmt->execute(); // Eksekusi statement
        
        // Cek apakah ada baris yang terpengaruh
        if ($stmt->affected_rows > 0) {
            // Ambil id_kembali dari tb_bayar
            $selectQuery = "SELECT id_kembali FROM tb_bayar WHERE id_bayar = ?";
            if ($selectStmt = $conn->prepare($selectQuery)) {
                $selectStmt->bind_param("s", $id_bayar);
                $selectStmt->execute();
                $selectStmt->bind_result($id_kembali);
                $selectStmt->fetch();
                $selectStmt->close();

                // Update kekurangan menjadi 0 di tb_transaksi berdasarkan id_kembali
                $updateTransaksi = "UPDATE tb_transaksi SET kekurangan = 0 WHERE id_transaksi = (SELECT id_transaksi FROM tb_kembali WHERE id_kembali = ?)";
                if ($stmtUpdate = $conn->prepare($updateTransaksi)) {
                    $stmtUpdate->bind_param("s", $id_kembali); // Bind parameter
                    $stmtUpdate->execute(); // Eksekusi statement
                }
            }

            // Redirect atau tampilkan pesan sukses
            echo "<script>alert('Pembayaran berhasil dikonfirmasi!'); window.location.href='tb_lunas.php';</script>";
            exit();
        } else {
            // Jika tidak ada data yang diupdate
            $_SESSION['error'] = "Pembayaran tidak ditemukan atau sudah dikonfirmasi!";
            header("Location: error.php"); // Ganti dengan halaman error yang sesuai
            exit();
        }

        $stmt->close(); // Tutup statement
    } else {
        // Jika terjadi kesalahan saat menyiapkan statement
        $_SESSION['error'] = "Terjadi kesalahan dalam pemrosesan!";
        header("Location: error.php");
        exit();
    }
} else {
    // Jika id_bayar tidak ditemukan
    $_SESSION['error'] = "ID Bayar tidak valid!";
    header("Location: error.php"); // Ganti dengan halaman error yang sesuai
    exit();
}

// Tutup koneksi
$conn->close();
?>
