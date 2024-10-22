<?php
include 'conn.php';

if (isset($_POST['btnLogin'])) {
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM tb_user WHERE username = '$username'";
        $result = $conn->query($query);

        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
            if (password_verify($password, $data['password'])) {
                session_start();
                $_SESSION['id_user'] = $data['id_user'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['role'] = $data['role'];

                if ($data['role'] == 'admin') {
                    header('location: admin/tb_user.php');
                } elseif ($data['role'] == 'petugas') {
                    header('location: petugas/index.php');
                }
                exit();
            } else {
                echo "<script>alert('Password salah!');</script>";
            }
        } else {
            echo "<script>alert('Username tidak ditemukan!');</script>";
        }
    } elseif (!empty($nik) && !empty($password)) {
        $query = "SELECT * FROM tb_member WHERE nik = '$nik'";
        $result = $conn->query($query);

        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
            if (password_verify($password, $data['password'])) {
                session_start();
                $_SESSION['nik'] = $data['nik'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['username'] = $data['username'];

                header('location: member/index.php');
                exit();
            } else {
                echo "<script>alert('Password salah!');</script>";
            }
        } else {
            echo "<script>alert('NIK tidak ditemukan!');</script>";
        }
    } else {
        echo "<script>alert('Username/NIK dan password harus diisi!');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, #1e3a8a, #4b5563, #1e40af, #1e3a8a);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .input-field {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            outline: none;
        }

        .form-container {
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-sm form-container">
            <h2 class="text-center text-white text-2xl font-bold mb-6">Login</h2>
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label for="nik" class="block text-white text-sm font-medium">NIK</label>
                    <input type="text" id="nik" name="nik"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="username" class="block text-white text-sm font-medium">Username</label>
                    <input type="text" id="username" name="username" placeholder="Kosongkan Jika Menggunakan NIK"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="password" class="block text-white text-sm font-medium">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <button type="submit" name="btnLogin"
                    class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-semibold transition transform hover:scale-105">Login</button>
            </form>
            <p class="mt-4 text-center text-white text-sm">
                Belum punya akun? <a href="regis.php"
                    class="text-blue-400 hover:text-blue-300 transition">Registrasi</a>
            </p>
        </div>
    </div>
</body>

</html>