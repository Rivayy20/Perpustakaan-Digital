<?php
include 'conn.php';

$id_transaksi = $_GET['id_transaksi'];

$query = "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if (isset($_POST['btnSimpan'])) {
    $tgl_kembali = $_POST['tgl_kembali'];
    $kondisi_mobil = $_POST['kondisi_mobil'];
    $denda = isset($_POST['denda']) && !empty($_POST['denda']) ? (float)$_POST['denda'] : 0;

    // Get tgl_kembali and dp from tb_transaksi
    $query_transaksi = "SELECT tgl_kembali, total, dp FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
    $result_transaksi = mysqli_query($conn, $query_transaksi);
    $row_transaksi = mysqli_fetch_assoc($result_transaksi);
    $tgl_kembali_transaksi = $row_transaksi['tgl_kembali'];
    $total_bayar = $row_transaksi['total'];
    $dp = $row_transaksi['dp'];

    // Calculate additional fee if tgl_kembali exceeds tgl_kembali in tb_transaksi
    if (strtotime($tgl_kembali) > strtotime($tgl_kembali_transaksi)) {
        $diff = strtotime($tgl_kembali) - strtotime($tgl_kembali_transaksi);
        $days_late = ceil($diff / (60 * 60 * 24));
        $additional_fee = $days_late * 100000;
        $denda += $additional_fee;
    }

    // Insert into tb_kembali
    $query_kembali = "INSERT INTO tb_kembali (id_transaksi, tgl_kembali, kondisi_mobil, denda) VALUES ('$id_transaksi', '$tgl_kembali', '$kondisi_mobil', '$denda')";
    if (mysqli_query($conn, $query_kembali)) {
        $id_kembali = mysqli_insert_id($conn);

        // Update total_bayar
        $total_bayar += $denda;

        // Calculate kekurangan
        $kekurangan = $total_bayar - $dp;

        // Insert into tb_bayar
        $total_bayar_bayar = $total_bayar - $dp;
        $query_bayar = "INSERT INTO tb_bayar (id_kembali, tgl_bayar, total_bayar, status) VALUES ('$id_kembali', NULL, '$total_bayar_bayar', 'belum lunas')";
        mysqli_query($conn, $query_bayar);

        // Update total in tb_transaksi
        $query_update_total_transaksi = "UPDATE tb_transaksi SET total = '$total_bayar' WHERE id_transaksi = '$id_transaksi'";
        mysqli_query($conn, $query_update_total_transaksi);

        // Update kekurangan in tb_transaksi
        $query_update_kekurangan_transaksi = "UPDATE tb_transaksi SET kekurangan = '$kekurangan' WHERE id_transaksi = '$id_transaksi'";
        mysqli_query($conn, $query_update_kekurangan_transaksi);

        // Update status in tb_mobil using nopol
        $query_update_mobil = "UPDATE tb_mobil SET status = 'tersedia' WHERE nopol = (SELECT nopol FROM tb_transaksi WHERE id_transaksi = '$id_transaksi')";
        mysqli_query($conn, $query_update_mobil);

        // Update status in tb_transaksi
        $query_update_transaksi = "UPDATE tb_transaksi SET status = 'kembali' WHERE id_transaksi = '$id_transaksi'";
        mysqli_query($conn, $query_update_transaksi);

        echo "<script>alert('Mobil berhasil dikembalikan!'); window.location.href='tb_kembali.php';</script>";
    } else {
        echo "<script>alert('Gagal mengembalikan mobil!'); window.location.href='tb_diambil.php';</script>";
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main content -->
        <main class="flex-1 p-6 bg-gray-900">
            <!-- Navbar with Profile and Sign Out -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Kembalikan Mobil</h1>
                <div class="relative">
                    <!-- Dropdown for Profile and Sign Out (Flowbite) -->
                    <button id="dropdownUserButton" data-dropdown-toggle="dropdownUser"
                        class="flex items-center text-sm focus:outline-none">
                        <img class="w-8 h-8 rounded-full" src="../dump/profile.jpg" alt="User Photo">
                        <span class="ml-2 text-gray-300"><?= $_SESSION['username'] ?></span>
                        <svg class="w-4 h-4 ml-1 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.292 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdownUser"
                        class="z-10 hidden bg-gray-800 divide-y divide-gray-700 rounded-lg shadow w-44">
                        <div class="px-4 py-3 text-sm text-gray-300">
                            <div class="font-medium truncate">
                                <?php
                                if ($_SESSION['role'] == 'admin') {
                                    echo 'Administrator';
                                } elseif ($_SESSION['role'] == 'petugas') {
                                    echo 'Petugas';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="py-1">
                            <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Sign
                                Out</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit User -->
            <div class="flex justify-center items-center bg-gray-900">
                <div class="max-w-md w-full bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8 mt-6">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Kembalikan Mobil</h2>
                    <form action="" method="POST" class="space-y-6">
                        <input type="hidden" name="id_user">

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300">Tanggal
                                Kembali</label>
                            <input type="date" name="tgl_kembali" id="username" value="<?= $row['tgl_kembali'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Kondisi Mobil</label>
                            <textarea name="kondisi_mobil" id="kondisi_mobil" rows="4"
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300">Denda</label>
                            <input type="text" name="denda" id="username" 
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <button type="submit" name="btnSimpan"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        </div>
                        <div class="mt-4">
                            <a href="tb_diambil.php"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>

</html>