<?php
include 'conn.php';

$nik = $_GET['nik'];
$sql = "SELECT * FROM tb_member WHERE nik = '$nik'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['btnUpdate'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_POST['password'] == '') {
        $sql = "UPDATE tb_member SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telp = '$telp', alamat = '$alamat', username = '$username' WHERE nik = '$nik'";
    } else {
        $sql = "UPDATE tb_member SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telp = '$telp', alamat = '$alamat', username = '$username', password = '$password' WHERE nik = '$nik'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate')</script>";
        echo "<script>window.location.replace('tb_member.php')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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
                <h1 class="text-2xl font-bold">Edit Member</h1>
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
                            <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit User -->
            <div class="flex justify-center items-center bg-gray-900">
                <div class="max-w-md w-full bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8 mt-6">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Update Member</h2>
                    <form action="" method="POST" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300">NIK</label>
                            <input type="text" name="nik" id="username" value="<?= $row['nik'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Nama</label>
                            <input type="text" name="nama" id="password" value="<?= $row['nama'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-300">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="role" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="L" <?= $row['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki - laki
                                </option>
                                <option value="P" <?= $row['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">No Telepon</label>
                            <input type="text" name="telp" id="password" value="<?= $row['telp'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-300">Alamat</label>
                            <textarea name="alamat" id="alamat" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= $row['alamat'] ?></textarea>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Username</label>
                            <input type="text" name="username" id="password" value="<?= $row['username'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <input type="password" name="password" id="password" placeholder="Kosongkan Jika Tidak Ingin Diubah"
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <button type="submit" name="btnUpdate"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Member
                            </button>
                        </div>
                        <div class="mt-4">
                            <a href="tb_member.php"
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