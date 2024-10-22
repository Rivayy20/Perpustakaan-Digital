<?php
include 'conn.php';

$id_user = $_GET['id_user'];
$sql = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(isset($_POST['btnUpdate'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    if ($_POST['password'] == '') {
        $sql = "UPDATE tb_user SET username = '$username', role = '$role' WHERE id_user = '$id_user'";
    } else {
        $sql = "UPDATE tb_user SET username = '$username', password = '$password', role = '$role' WHERE id_user = '$id_user'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate')</script>";
        echo "<script>window.location.replace('tb_user.php')</script>";
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
                <h1 class="text-2xl font-bold">Edit User</h1>
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
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">Update User</h2>
                    <form action="" method="POST" class="space-y-6">
                        <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
                            <input type="text" name="username" id="username" value="<?= $row['username'] ?>" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                            <input type="password" name="password" id="password" placeholder="Kosongkan Jika Tidak Ingin Diubah"
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-300">Role</label>
                            <select name="role" id="role" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Administrator
                                </option>
                                <option value="petugas" <?= $row['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" name="btnUpdate"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update User
                            </button>
                        </div>
                        <div class="mt-4">
                            <a href="tb_user.php"
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