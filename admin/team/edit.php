<?php
session_start();
include '../../config.php';

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Ambil ID dari query string
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit();
}

// Ambil data berdasarkan ID dari tabel team
$stmt = $conn->prepare("SELECT * FROM team WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$data = $res->fetch_assoc();
$stmt->close();

if (!$data) {
    // jika tidak ditemukan, kembali ke index
    header("Location: index.php");
    exit();
}

// Sediakan variabel aman untuk menghindari "Undefined array key"
$name      = isset($data['name']) ? $data['name'] : '';
$nim       = isset($data['nim']) ? $data['nim'] : '';
$email     = isset($data['email']) ? $data['email'] : '';
$instagram = isset($data['instagram']) ? $data['instagram'] : '';
$telpon    = isset($data['telpon']) ? $data['telpon'] : '';
$image     = isset($data['image']) ? $data['image'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota Team</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0d1b25] text-white min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0b1621] h-screen px-6 py-8 flex flex-col fixed left-0 top-0">
        <div class="flex flex-col items-center space-y-3 mb-10">
            <img src="../../assets/img/logo.png" class="w-14 h-14" alt="logo">
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

        <a href="../../logout.php"
           class="mt-auto bg-red-500 text-white px-6 py-3 rounded-lg font-semibold text-center block">
           Logout
        </a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10 ml-64">
        <h2 class="text-3xl font-bold mb-6">Edit Anggota Team</h2>

        <form action="update.php" method="POST" enctype="multipart/form-data"
              class="bg-[#12222f] p-8 rounded-xl border border-gray-700 w-full max-w-2xl">

            <!-- hidden id -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <div class="mb-4">
                <label class="block mb-1">Nama</label>
                <input type="text" name="name" required
                       value="<?= htmlspecialchars($name) ?>"
                       class="mt-1 w-full p-3 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">NIM</label>
                <input type="text" name="nim" required
                       value="<?= htmlspecialchars($nim) ?>"
                       class="mt-1 w-full p-3 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email"
                       value="<?= htmlspecialchars($email) ?>"
                       class="mt-1 w-full p-3 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Instagram (tanpa @)</label>
                <input type="text" name="instagram"
                       value="<?= htmlspecialchars($instagram) ?>"
                       class="mt-1 w-full p-3 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Telpon</label>
                <input type="text" name="telpon"
                       value="<?= htmlspecialchars($telpon) ?>"
                       class="mt-1 w-full p-3 rounded bg-[#0b1621] border border-gray-700 text-white">
            </div>

            <div class="mb-6">
                <label class="block mb-2">Foto Anggota saat ini</label>
                <?php if (!empty($image) && file_exists(__DIR__ . '/../../images/' . $image)) : ?>
                    <img src="../../images/<?= htmlspecialchars($image) ?>" alt="foto" class="w-28 h-28 object-cover rounded-lg mb-3">
                <?php else: ?>
                    <div class="w-28 h-28 bg-gray-700 flex items-center justify-center rounded-lg mb-3 text-sm">
                        No Image
                    </div>
                <?php endif; ?>

                <label class="block mb-1">Ganti Foto (opsional)</label>
                <input type="file" name="image" class="w-full text-white">
                <p class="text-sm text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 px-6 py-3 rounded-lg font-semibold">
                    Update
                </button>

                <a href="index.php" class="inline-block px-6 py-3 border border-gray-600 rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </main>

</body>
</html>
