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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

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
                <h1 class="text-2xl font-bold">Laporan Transaksi</h1>
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

            <div class="flex justify-start mb-6">
                <a href="cetak_laporan.php" target="_blank"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <span class="mr-2">Download Laporan</span>
                    <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>


            <!-- Table User -->
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table id="dataTable" class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                No Polisi
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tanggal Ambil
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Tanggal Kembali
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Supir
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Total Biaya
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Bayar Dp
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT tb_transaksi.nik, tb_transaksi.nopol, tb_transaksi.tgl_booking, tb_transaksi.tgl_ambil, tb_transaksi.tgl_kembali, tb_transaksi.supir, tb_transaksi.total, tb_transaksi.dp, tb_bayar.status 
                            FROM tb_transaksi 
                            JOIN tb_kembali ON tb_transaksi.id_transaksi = tb_kembali.id_transaksi
                            JOIN tb_bayar ON tb_kembali.id_kembali = tb_bayar.id_kembali
                            WHERE tb_bayar.status = 'lunas'";
                        $result = $conn->query($sql);
                        $no = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr class="bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['nik']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['nopol']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['tgl_ambil']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['tgl_kembali']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['supir'] == 1 ? 'Ya' : 'Tidak'; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        Rp
                                        <?= number_format($row['total'], 0, ',', '.'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        Rp
                                        <?= number_format($row['dp'], 0, ',', '.'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['status']; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>