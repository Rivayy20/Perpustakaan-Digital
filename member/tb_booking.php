<?php
include 'conn.php';

$nopol = isset($_GET['nopol']) ? $_GET['nopol'] : '';

if (isset($_POST['btnSimpan'])) {
    $nik = $_SESSION['nik'];
    $tgl_ambil = $_POST['tgl_ambil'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $supir = $_POST['supir'];
    $dp = $_POST['dp'];
    $tgl_booking = date('Y-m-d');
    
    // Calculate total days
    $datetime1 = new DateTime($tgl_ambil);
    $datetime2 = new DateTime($tgl_kembali);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->days + 1; // Include the start day

    // Get harga_per_hari from tb_mobil based on nopol
    $result = mysqli_query($conn, "SELECT harga FROM tb_mobil WHERE nopol='$nopol'");
    $row = mysqli_fetch_assoc($result);
    $harga_per_hari = $row['harga'];

    // Calculate total cost
    $biaya_supir = $supir == 1 ? 100000 : 0;
    $total = ($harga_per_hari * $days) + $biaya_supir;

    // Calculate remaining amount
    $kekurangan = $total - $dp;

    // Insert into tb_transaksi
    $query = "INSERT INTO tb_transaksi (nik, nopol, tgl_booking, tgl_ambil, tgl_kembali, supir, total, dp, kekurangan, status) 
              VALUES ('$nik', '$nopol', '$tgl_booking', '$tgl_ambil', '$tgl_kembali', '$supir', '$total', '$dp', '$kekurangan', 'booking')";
    
    if (mysqli_query($conn, $query)) {
        // Update status in tb_mobil
        $updateQuery = "UPDATE tb_mobil SET status='kosong' WHERE nopol='$nopol'";
        mysqli_query($conn, $updateQuery);
        
        echo "<script>alert('Booking berhasil'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan booking');</script>";
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
    
    <title>Member Dashboard</title>
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
                <h1 class="text-2xl font-bold">Booking Mobil</h1>
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
                            <div class="font-medium truncate"><?= $_SESSION['nik'] ?></div>
                        </div>
                        <div class="py-1">
                            <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Sign
                                Out</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Booking Mobil -->
            <div class="flex justify-center items-center bg-gray-900">
                <div class="max-w-md w-full bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8 mt-6">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Booking Mobil</h2>
                    <form action="" method="POST" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300">NIK</label>
                            <input type="text" name="nik" id="username" value="<?= htmlspecialchars($nik) ?>" disabled
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">No Polisi</label>
                            <input type="text" name="nopol" id="password" value="<?= htmlspecialchars($nopol) ?>" disabled
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Tanggal Ambil</label>
                            <input type="date" name="tgl_ambil" id="password"  required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali" id="password"  required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="supir" class="block text-sm font-medium text-gray-300">Supir</label>
                            <select name="supir" id="supir" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Dp</label>
                            <input type="text" name="dp" id="password"  required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <button type="submit" name="btnSimpan"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        </div>
                        <div class="mt-4">
                            <a href="index.php"
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