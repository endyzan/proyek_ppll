<?php
session_start();
include "../../config.php";

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// CEK ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Ambil data blog
$q = mysqli_query($conn, "SELECT * FROM sharing WHERE id='$id'");
$blog = mysqli_fetch_assoc($q);

if (!$blog) {
    header("Location: index.php");
    exit();
}

// UPDATE DATA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar    = $blog['gambar'];

    // Jika user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $namaFile = time() . "_" . $_FILES['gambar']['name'];
        $tmp      = $_FILES['gambar']['tmp_name'];
        $folder   = "../../assets/uploads/sharing/" . $namaFile;

        move_uploaded_file($tmp, $folder);

        // Hapus gambar lama jika ada
        if ($blog['gambar'] && file_exists("../../assets/uploads/sharing/" . $blog['gambar'])) {
            unlink("../../assets/uploads/sharing/" . $blog['gambar']);
        }

        $gambar = $namaFile;
    }

    mysqli_query($conn, "UPDATE sharing SET 
        judul='$judul',
        deskripsi='$deskripsi',
        gambar='$gambar',
        updated_at = NOW()
        WHERE id='$id'
    ");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
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
            <a href="./index.php" class="text-blue-400 font-semibold block">Manage Blog</a>
            <a href="../team/index.php" class="text-gray-300 hover:text-white block">Manage Team</a>
        </nav>

        <a href="../../logout.php"
           class="mt-auto bg-red-500 text-white px-6 py-3 rounded-lg font-semibold text-center block">
           Logout
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10 ml-64">

        <h2 class="text-3xl font-bold mb-6">Edit Blog</h2>

        <form method="POST" enctype="multipart/form-data" 
              class="bg-[#12222f] p-6 rounded-xl shadow-lg space-y-5 max-w-3xl">

            <div>
                <label class="block mb-2 font-semibold">Judul</label>
                <input type="text" name="judul" value="<?= $blog['judul']; ?>" required
                       class="w-full px-4 py-3 rounded-lg bg-[#1b2c39] border border-gray-700 focus:outline-none">
            </div>

            <div>
                <label class="block mb-2 font-semibold">Deskripsi</label>
                <textarea name="deskripsi" rows="8" required
                          class="w-full px-4 py-3 rounded-lg bg-[#1b2c39] border border-gray-700 focus:outline-none"><?= $blog['deskripsi']; ?></textarea>
            </div>

            <div>
                <label class="block mb-2 font-semibold">Gambar Saat Ini</label>
                <?php if ($blog['gambar']) { ?>
                    <img src="../../assets/uploads/sharing/<?= $blog['gambar']; ?>" class="w-32 rounded-lg mb-3">
                <?php } else { ?>
                    <p class="text-gray-400 mb-3">Tidak ada gambar</p>
                <?php } ?>
            </div>

            <div>
                <label class="block mb-2 font-semibold">Gambar Baru (Opsional)</label>
                <input type="file" name="gambar"
                       class="w-full px-4 py-3 rounded-lg bg-[#1b2c39] border border-gray-700 cursor-pointer">
            </div>

            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg font-semibold">
                Simpan Perubahan
            </button>

            <a href="index.php"
               class="ml-4 text-gray-300 hover:text-white underline">
               Batal
            </a>

        </form>

    </main>

</body>
</html>
