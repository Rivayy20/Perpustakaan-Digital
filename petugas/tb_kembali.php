<?php
include 'conn.php';

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
                <h1 class="text-2xl font-bold">Transaksi Member (Kembali)</h1>
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

            <!-- Button -->
            <div class="flex justify-center space-x-4">
                <a href="tb_transaksi.php"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                    Booking
                </a>
                <a href="tb_approve.php"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
                    Approve
                </a>
                <a href="tb_diambil.php"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 rounded-lg hover:bg-teal-700">
                    Diambil
                </a>
                <a href="tb_kembali.php"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Kembali
                </a>
            </div>

            <!-- Card Mobil -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 mt-6">
                <?php
                $query = "SELECT tb_transaksi.*, tb_mobil.brand, tb_mobil.type, tb_mobil.nopol, tb_mobil.tahun, tb_mobil.harga, tb_mobil.foto 
                          FROM tb_transaksi 
                          JOIN tb_mobil ON tb_transaksi.nopol = tb_mobil.nopol
                          WHERE tb_transaksi.status = 'kembali'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="max-w-sm bg-gray-800 border border-gray-700 rounded-lg shadow">
                            <img class="rounded-t-lg w-full h-48 object-cover" src="../image/<?php echo $row['foto']; ?>"
                                alt="Car Image">
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                                    <?php echo $row['brand'] . ' ' . $row['type']; ?>
                                </h5>
                                <p class="text-gray-400 mb-2">NIK Member: <span
                                        class="text-white"><?php echo $row['nik']; ?></span></p>
                                <p class="text-gray-400 mb-2">No Polisi: <span
                                        class="text-white"><?php echo $row['nopol']; ?></span></p>
                                <p class="text-gray-400 mb-2">Tanggal Booking: <span
                                        class="text-white"><?php echo $row['tgl_booking']; ?></span></p>
                                <p class="text-gray-400 mb-2">Tanggal Ambil: <span
                                        class="text-white"><?php echo $row['tgl_ambil']; ?></span></p>
                                <p class="text-gray-400 mb-2">Tanggal Kembali: <span
                                        class="text-white"><?php echo $row['tgl_kembali']; ?></span></p>
                                <p class="text-gray-400 mb-2">Supir: <span
                                        class="text-white"><?php echo $row['supir'] == 1 ? 'Ya' : 'Tidak'; ?></span></p>
                                <p class="text-gray-400 mb-2">Total Harga: <span class="text-white">Rp
                                        <?php echo number_format($row['total'], 0, ',', '.'); ?></span></p>
                                <p class="text-gray-400 mb-2">Bayar Dp: <span class="text-white">Rp
                                        <?php echo number_format($row['dp'], 0, ',', '.'); ?></span></p>
                                <p class="text-gray-400 mb-2">Kekurangan: <span class="text-white">Rp
                                        <?php echo number_format($row['kekurangan'], 0, ',', '.'); ?></span></p>
                                <p class="text-gray-400 mb-2">Status: <span
                                        class="text-green-500"><?php echo $row['status']; ?></span></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-white'>Belum Ada Transaksi Apapun.</p>";
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>