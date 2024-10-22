<?php
include 'conn.php';

if (isset($_POST['btnSimpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_member (nik, nama, jenis_kelamin, telp, alamat, username, password) VALUES ('$nik', '$nama', '$jenis_kelamin', '$telp', '$alamat', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href='tb_member.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
                <h1 class="text-2xl font-bold">Data Member</h1>
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

            <div class="flex justify-center mt-6 mb-6">
                <!-- Modal toggle -->
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Tambah Member
                </button>

                <!-- Main modal -->
                <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-gray-800 rounded-lg shadow dark:bg-gray-800">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-white dark:text-white"></h3>
                                Create Member
                                </h3>
                                <button type="button"
                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="authentication-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form action="" method="POST" class="space-y-4">
                                    <div>
                                        <label for="username" class="block text-sm font-medium">NIK</label>
                                        <input type="text" id="username" name="nik"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium">Nama</label>
                                        <input type="text" id="password" name="nama"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                    </div>
                                    <div>
                                        <label for="gender" class="block text-sm font-medium">Jenis Kelamin</label>
                                        <select id="gender" name="jenis_kelamin"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium">No Telepon</label>
                                        <input type="text" id="password" name="telp"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                    </div>
                                    <div>
                                        <label for="alamat" class="block text-sm font-medium">Alamat</label>
                                        <textarea id="alamat" name="alamat" rows="3"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required></textarea>
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium">Username</label>
                                        <input type="text" id="password" name="username"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                    </div>
                                    <button type="submit" name="btnSimpan"
                                        class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-semibold transition">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Member -->
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                No Telepon
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tb_member";
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
                                        <?= $row['nama']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['jenis_kelamin']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['telp']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['alamat']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <?= $row['username']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="edit_member.php?nik=<?= $row['nik']; ?>"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Edit</a>
                                        <a href="hapus_member.php?nik=<?= $row['nik']; ?>"
                                            onclick="return confirm('Apakah Anda Yakin?')"
                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            Hapus</a>
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