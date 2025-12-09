<?php
include "../../config.php";

// Ambil semua data discovery
$result = $conn->query("SELECT * FROM discoveries ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekomendasi Discovery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f7f9fc] min-h-screen">

    <!-- HEADER -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-700">✨ Rekomendasi Skintone</h1>
        <a href="../../index.php" class="text-blue-600 font-semibold hover:underline">Kembali</a>
    </header>

    <!-- CONTENT WRAPPER -->
    <div class="max-w-6xl mx-auto p-6">

        <p class="text-gray-600 text-lg mb-6">
            Temukan rekomendasi skintone terbaik berdasarkan undertone, depth, dan jenis kulit.
        </p>

        <!-- GRID CARD -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php while ($row = $result->fetch_assoc()): ?>
                
                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                    
                    <h2 class="text-xl font-bold text-gray-800 mb-2">
                        <?= $row['title']; ?>
                    </h2>

                    <div class="text-sm text-gray-500 mb-4">
                        Undertone: <span class="font-semibold text-gray-700"><?= $row['undertone']; ?></span> · 
                        Depth: <span class="font-semibold text-gray-700"><?= $row['depth']; ?></span> · 
                        Skin: <span class="font-semibold text-gray-700"><?= $row['skin_type']; ?></span>
                    </div>

                    <p class="text-gray-700 mb-4">
                        <?= nl2br(substr($row['recommendation'], 0, 150)); ?>...
                    </p>

                    <a href="discovery_detail.php?id=<?= $row['id']; ?>"
                       class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                       Lihat Detail
                    </a>

                </div>

            <?php endwhile; ?>

        </div>
    </div>

</body>
</html>
