<?php
include 'conn.php';

if (isset($_POST['btnSimpan'])) {
    $nopol = $_POST['nopol'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    $randomNumber = rand(100, 999);
    $foto = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNewName = $randomNumber . '-' . $foto;
    $fotoDestination = '../image/' . $fotoNewName;

    if (move_uploaded_file($fotoTmp, $fotoDestination)) {
        $query = "INSERT INTO tb_mobil (nopol, brand, type, tahun, harga, foto, status) VALUES ('$nopol', '$brand', '$type', '$tahun', '$harga', '$fotoNewName', '$status')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data mobil berhasil ditambahkan.'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengupload foto.";
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
                <h1 class="text-2xl font-bold">Data Mobil</h1>
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

            <!-- Modal Data Mobil -->
            <div class="flex justify-center mt-6 mb-6">
                <!-- Modal toggle -->
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Tambah Mobil
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
                                Data Mobil
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
                                <form class="space-y-4" action="" method="post" enctype="multipart/form-data">
                                    <div>
                                        <label for="username"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            No. Polisi</label>
                                        <input type="text" name="nopol"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            brand</label>
                                        <input type="text" name="brand" id="password"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            Tipe Mobil</label>
                                        <input type="text" name="type" id="password"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            Tahun</label>
                                        <input type="text" name="tahun" id="password"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            Harga / Hari</label>
                                        <input type="text" name="harga" id="password"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            Foto Mobil</label>
                                        <input type="file" name="foto" id="password"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                    <div>
                                        <label for="role"
                                            class="block mb-2 text-sm font-medium text-white dark:text-white">
                                            Status</label>
                                        <select name="status" id="role"
                                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            required>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="kosong">Kosong</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="btnSimpan"
                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Mobil -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 mt-6">
                <?php
                $query = "SELECT * FROM tb_mobil";
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
                                <p class="text-gray-400 mb-2">No Polisi: <span
                                        class="text-white"><?php echo $row['nopol']; ?></span></p>
                                <p class="text-gray-400 mb-2">Tahun: <span
                                        class="text-white"><?php echo $row['tahun']; ?></span></p>
                                <p class="text-gray-400 mb-2">Harga / Hari: <span class="text-white">Rp
                                        <?php echo number_format($row['harga'], 0, ',', '.'); ?></span></p>
                                <p class="text-gray-400 mb-2">Status: <span
                                        class="<?php echo $row['status'] == 'tersedia' ? 'text-green-500' : 'text-red-500'; ?>"><?php echo ucfirst($row['status']); ?></span>
                                </p>

                                <div class="flex justify-start space-x-2 mt-4">
                                    <a href="edit_mobil.php?nopol=<?php echo $row['nopol']; ?>"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Edit</a>
                                    <a href="hapus_mobil.php?nopol=<?php echo $row['nopol']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">Hapus</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-white'>Tidak ada data mobil.</p>";
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>