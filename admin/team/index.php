<?php
session_start();
include "../../config.php";

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil data team
$query = mysqli_query($conn, "SELECT * FROM team ORDER BY id ASC");
$no = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage Team</title>
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

        <!-- MENU -->
        <nav class="flex-grow space-y-6 text-lg">
            <a href="../index.php" class="text-gray-300 hover:text-white block">Dashboard</a>
            <a href="../product/index.php" class="text-gray-300 hover:text-white block">Manage Products</a>
            <a href="../discovery/index.php" class="text-gray-300 hover:text-white block">Manage Discovery</a>
            <a href="../blog/index.php" class="text-gray-300 hover:text-white block">Manage Blog</a>
            <a href="index.php" class="text-blue-400 font-semibold block">Manage Team</a>
        </nav>

        <a href="../../logout.php"
           class="mt-auto bg-red-500 text-white px-6 py-3 rounded-lg font-semibold text-center block">
           Logout
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10 ml-64">

        <h2 class="text-3xl font-bold mb-6">Manage Team</h2>

        <a href="create.php"
           class="inline-block bg-blue-500 hover:bg-blue-600 px-5 py-3 rounded-lg font-medium mb-5">
           + Tambah Anggota
        </a>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-700 bg-[#12222f] rounded-xl overflow-hidden">
                <thead class="bg-[#1f3647]">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Foto</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">NIM</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Instagram</th>
                        <th class="p-3 text-left">Telpon</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr class="border-t border-gray-700">
                        <td class="p-3"><?= $no++; ?></td>

                        <td class="p-3">
                            <img src="../../images/<?= $row['image']; ?>"
                                 class="w-20 h-20 object-cover rounded-lg shadow">
                        </td>

                        <td class="p-3 font-semibold"><?= $row['name']; ?></td>
                        <td class="p-3"><?= $row['nim']; ?></td>
                        <td class="p-3"><?= $row['email']; ?></td>
                        <td class="p-3"><?= $row['instagram']; ?></td>
                        <td class="p-3"><?= $row['telpon']; ?></td>

                        <td class="p-3 space-x-3">
                            <a href="edit.php?id=<?= $row['id']; ?>"
                               class="text-blue-400 hover:underline">Edit</a>

                            <a href="delete.php?id=<?= $row['id']; ?>"
                               class="text-red-400 hover:underline"
                               onclick="return confirm('Yakin hapus anggota ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>
