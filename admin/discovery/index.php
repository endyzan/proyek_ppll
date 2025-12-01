<?php
session_start();
include '../../config.php';

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Ambil semua data dari tabel discoveries
$result = $conn->query("SELECT * FROM discoveries ORDER BY id DESC");
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage Discovery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0d1b25] text-white min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0b1621] h-screen px-6 py-8 flex flex-col fixed left-0 top-0">

        <!-- LOGO -->
        <div class="flex flex-col items-center space-y-3 mb-10">
            <img src="../../assets/img/logo.png" class="w-14 h-14" />
            <h1 class="font-bold text-xl">ADMIN</h1>
        </div>

        <div class="border-b border-gray-700 mb-6"></div>

        <!-- MENU -->
        <nav class="flex-grow space-y-6 text-lg">
            <a href="../index.php" class="text-gray-300 hover:text-white block">Dashboard</a>
            <a href="../product/index.php" class="text-gray-300 hover:text-white block">Manage Products</a>
            <a href="index.php" class="text-blue-400 font-semibold block">Manage Discovery</a>
            <a href="../blog/index.php" class="text-gray-300 hover:text-white block">Manage Blog</a>
            <a href="../team/index.php" class="text-gray-300 hover:text-white block">Manage team</a>
        </nav>

        <!-- LOGOUT -->
        <a href="../../logout.php"
           class="mt-auto bg-red-500 text-white px-6 py-3 rounded-lg font-semibold text-center block">
           Logout
        </a>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10 ml-64">

        <h1 class="text-3xl font-bold mb-4">Manage Discovery</h1>
        <!-- <p class="text-lg text-gray-300 mb-8">Halo, <span class="font-semibold text-white"><?= $username ?></span>.</p> -->

        <a href="create.php"
           class="inline-block bg-blue-500 hover:bg-blue-600 px-5 py-3 rounded-lg mb-6 font-medium">
           + Tambah Discovery Baru
        </a>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-700 bg-[#12222f] rounded-xl overflow-hidden">
                <thead class="bg-[#1f3647]">
                    <tr>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Undertone</th>
                        <th class="p-3 text-left">Depth</th>
                        <th class="p-3 text-left">Skin Type</th>
                        <th class="p-3 text-left">Recommendation</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="border-t border-gray-700">
                        <td class="p-3"><?= $row['id']; ?></td>
                        <td class="p-3"><?= $row['title']; ?></td>
                        <td class="p-3"><?= $row['undertone']; ?></td>
                        <td class="p-3"><?= $row['depth']; ?></td>
                        <td class="p-3"><?= $row['skin_type']; ?></td>
                        <td class="p-3">
                            <?= substr($row['recommendation'], 0, 50) . '...'; ?>
                        </td>
                        <td class="p-3 space-x-3">
                            <a href="edit.php?id=<?= $row['id']; ?>"
                               class="text-blue-400 hover:underline">Edit</a>

                            <a href="delete.php?id=<?= $row['id']; ?>"
                               class="text-red-400 hover:underline"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>
