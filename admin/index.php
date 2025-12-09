<?php
session_start();

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0d1b25] text-white min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0b1621] h-screen px-6 py-8 flex flex-col fixed left-0 top-0">
        
        <!-- LOGO -->
        <div class="flex flex-col items-center space-y-3 mb-10">
            <img src="../assets/img/logo.png" class="w-14 h-14" />
            <h1 class="font-bold text-xl">ADMIN</h1>
        </div>

        <div class="border-b border-gray-700 mb-6"></div>

        <!-- MENU -->
        <nav class="flex-grow space-y-6 text-lg">
            <a href="index.php" class="text-blue-400 font-semibold block">Dashboard</a>
            <a href="manage_users.php" class="text-gray-300 hover:text-white block">Manage Users</a>
            <a href="../admin/product/index.php" class="text-gray-300 hover:text-white block">Manage Products</a>
            <a href="settings.php" class="text-gray-300 hover:text-white block">Settings</a>
        </nav>

        <!-- LOGOUT -->
        <a href="../logout.php"
           class="mt-auto bg-red-500 text-white px-6 py-3 rounded-lg font-semibold text-center block">
           Logout
        </a>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10 ml-64">

        <h1 class="text-3xl font-bold mb-4">Selamat Datang Admin!</h1>
        <p class="text-lg text-gray-300 mb-8">Halo, <span class="font-semibold text-white"><?= $username ?></span>.</p>

        <!-- CARD GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- CARD 1 -->
            <div class="bg-[#12222f] p-6 rounded-xl shadow-xl border border-[#1f3647]">
                <h2 class="text-xl font-bold mb-3">Manage Users</h2>
                <p class="text-gray-300 mb-4">Lihat, tambah, edit, atau hapus data user.</p>
                <a href="manage_users.php" class="inline-block bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">
                    Kelola
                </a>
            </div>

            <!-- CARD 2 -->
            <div class="bg-[#12222f] p-6 rounded-xl shadow-xl border border-[#1f3647]">
                <h2 class="text-xl font-bold mb-3">Manage Products</h2>
                <p class="text-gray-300 mb-4">Kelola seluruh produk dalam sistem.</p>
                <a href="../admin/product/index.php" class="inline-block bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">
                    Kelola
                </a>
            </div>

            <!-- CARD 3 -->
            <div class="bg-[#12222f] p-6 rounded-xl shadow-xl border border-[#1f3647]">
                <h2 class="text-xl font-bold mb-3">Settings</h2>
                <p class="text-gray-300 mb-4">Pengaturan dashboard admin.</p>
                <a href="settings.php" class="inline-block bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">
                    Buka
                </a>
            </div>

        </div>

    </main>

</body>
</html>
