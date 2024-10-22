<?php
include 'conn.php';

$nopol = $_GET['nopol'];

$query = "SELECT * FROM tb_mobil WHERE nopol='$nopol'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnSimpan'])) {
    $oldNopol = $_GET['nopol']; // Nopol lama yang akan di-update
    $nopol = $_POST['nopol']; // Nopol baru (jika diubah)
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = str_replace('.', '', $_POST['harga']);
    $status = $_POST['status'];

    // Ambil data mobil berdasarkan oldNopol untuk mendapatkan foto lama
    $query = "SELECT foto FROM tb_mobil WHERE nopol='$oldNopol'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Default to existing photo
    $foto = $row['foto'];

    // Handle file upload jika ada file foto baru
    if (!empty($_FILES['foto']['name'])) {
        // Hapus file foto lama jika ada
        if (!empty($row['foto']) && file_exists("../image/" . $row['foto'])) {
            unlink("../image/" . $row['foto']);
        }

        // Upload foto baru
        $randomNumber = rand(100, 999); // Random number untuk mencegah nama file yang sama
        $foto = $randomNumber . '-' . basename($_FILES['foto']['name']);
        $targetFilePath = "../image/" . $foto;

        // Pindahkan file ke folder yang ditentukan
        move_uploaded_file($_FILES['foto']['tmp_name'], $targetFilePath);
    }

    // Update data mobil
    $updateQuery = "UPDATE tb_mobil SET nopol='$nopol', brand='$brand', type='$type', tahun='$tahun', harga='$harga', foto='$foto', status='$status' WHERE nopol='$oldNopol'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Data mobil berhasil diupdate'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data mobil');</script>";
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
                <h1 class="text-2xl font-bold">Edit Mobil</h1>
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

            <!-- Form Edit Mobil -->
            <div class="flex justify-center items-center bg-gray-900">
                <div class="max-w-md w-full bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8 mt-6">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Edit Mobil</h2>
                    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300">No Polisi</label>
                            <input type="text" name="nopol" id="username" value="<?= $row['nopol'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-300">Brand</label>
                            <input type="text" name="brand" id="brand" value="<?= $row['brand'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-300">Tipe Mobil</label>
                            <input type="text" name="type" id="type" value="<?= $row['type'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-300">Tahun</label>
                            <input type="text" name="tahun" id="year" value="<?= $row['tahun'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-300">Harga / Hari</label>
                            <input type="text" name="harga" id="price"
                                value="<?= number_format($row['harga'], 0, ',', '.') ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-300">Foto</label>
                            <input type="file" name="foto" id="photo"
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php if (!empty($row['foto'])): ?>
                                <img src="../image/<?= $row['foto'] ?>" alt="Foto Mobil"
                                    class="mt-4 w-full h-auto rounded-md">
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300">Status</label>
                            <select name="status" id="status" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="tersedia" <?= $row['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia
                                </option>
                                <option value="kosong" <?= $row['status'] == 'kosong' ? 'selected' : '' ?>>Kosong</option>
                            </select>
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