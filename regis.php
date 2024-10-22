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
        echo "<script>alert('Registrasi berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap');

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
            <h2 class="text-center text-2xl text-white font-bold mb-6">Registrasi Member</h2>
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="nik" class="block text-sm text-white font-medium">NIK</label>
                    <input type="text" id="nik" name="nik"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="nama" class="block text-sm text-white font-medium">Nama</label>
                    <input type="text" id="nama" name="nama"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="gender" class="block text-sm text-white font-medium">Jenis Kelamin</label>
                    <select id="gender" name="jenis_kelamin"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="telp" class="block text-sm text-white font-medium">No Telepon</label>
                    <input type="text" id="telp" name="telp"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="alamat" class="block text-sm text-white font-medium">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>
                <div>
                    <label for="username" class="block text-sm text-white font-medium">Username</label>
                    <input type="text" id="username" name="username"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <div>
                    <label for="password" class="block text-sm text-white font-medium">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full mt-1 p-2 bg-gray-700 text-white rounded-lg input-field focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <button type="submit" name="btnSimpan"
                    class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-semibold transition transform hover:scale-105">Simpan</button>
            </form>
            <p class="mt-4 text-center text-white text-sm">
                Sudah punya akun? <a href="index.php" class="text-blue-400 hover:text-blue-300 transition">Login</a>
            </p>
        </div>
    </div>
</body>

</html>