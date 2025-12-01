<?php
include "../../config.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM discoveries WHERE id = $id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $data['title'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f7f9fc] min-h-screen">

    <div class="max-w-4xl mx-auto p-6">

        <a href="discovery_user.php" class="text-blue-600 hover:underline text-lg">← Kembali</a>

        <div class="bg-white shadow-xl rounded-xl p-8 mt-4 border border-gray-200">

            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                <?= $data['title']; ?>
            </h1>

            <div class="text-gray-600 mb-6">
                Undertone: <b><?= $data['undertone']; ?></b> · 
                Depth: <b><?= $data['depth']; ?></b> · 
                Skin Type: <b><?= $data['skin_type']; ?></b>
            </div>

            <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                <?= $data['recommendation']; ?>
            </p>

        </div>

    </div>

</body>
</html>
