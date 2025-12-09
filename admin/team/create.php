<?php
session_start();
include "../../config.php";

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $instagram = $_POST['instagram'];
    $telpon = $_POST['telpon'];

    // Upload Foto
    $imageName = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // Pindahkan file ke folder images
    $uploadPath = "../../images/" . $imageName;
    move_uploaded_file($tmp, $uploadPath);

    // Insert ke database
    $query = "INSERT INTO team (name, nim, image, email, instagram, telpon)
              VALUES ('$name', '$nim', '$imageName', '$email', '$instagram', '$telpon')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota Team</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0d1b25] text-white min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0b1621] h-screen px-6 py-8 flex flex-col fixed left-0 top-0">
        
        <div class="flex flex-col items-center space-y-3 mb-10">
            <img src="../../assets/img/logo.png" class="w-14 h-14">
            <h1 class="font-bold text-xl">ADMIN</h1>
        </div>

        <div class="border-b border-gray-700 mb-6"></div>

        <nav class="flex-grow space-y-6 text-lg">
            <a href="../index.php" class="text-gray-300 hover:text-white block">Dashboard</a>
            <a href="../product/index.php" class="text-gray-300 hover:text-white block">Manage Products</a>
            <a href="../discovery/index.php" class="text-gray-300 hover:text-white block">Manage Discovery</a>
            <a href="../blog/index.php" class="text-gray-300 hover:text-white block">Manage Blog</a>
            <a href="index.php" class="text-blue-400 font-semibold block">Manage Team</a>
        </nav>

        <a href="../../logout.php" class="mt-auto bg-red-500 text-white px-6 py-3 rounded-lg font-semibold text-center block">
            Logout
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10 ml-64">

        <h2 class="text-3xl font-bold mb-6">Tambah Anggota Team</h2>

        <form action="" method="POST" enctype="multipart/form-data" 
              class="bg-[#12222f] p-8 rounded-xl border border-gray-700 w-full">

            <div class="mb-4">
                <label class="block mb-1">Nama</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">NIM</label>
                <input type="text" name="nim" required
                       class="w-full px-4 py-2 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email"
                       class="w-full px-4 py-2 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Instagram (tanpa @)</label>
                <input type="text" name="instagram"
                       class="w-full px-4 py-2 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Telpon</label>
                <input type="text" name="telpon"
                       class="w-full px-4 py-2 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-6">
                <label class="block mb-1">Foto Anggota</label>
                <input type="file" name="image" required 
                       class="w-full text-white">
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg font-semibold">
                Simpan
            </button>

        </form>

    </main>

</body>
</html>
