<?php 
include "config.php";

// Ambil semua data team
$query = mysqli_query($conn, "SELECT * FROM team ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Rosé Beauty</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body class="bg-[#FDEEF0] text-[#8D5B66]">

    <!-- NAVBAR -->
    <div id="navbar-placeholder"></div>

    <main class="py-16">
        <section class="container mx-auto px-6">

            <!-- Header -->
            <div class="text-center mb-14">
                <h1 class="font-playfair text-4xl md:text-5xl font-bold">Meet Our Team</h1>
                <p class="max-w-xl mx-auto mt-4 text-[#716F7B]">
                    Kami adalah sekelompok individu yang bersemangat tentang kecantikan dan inovasi. 
                    Misi kami adalah menghadirkan produk terbaik untuk Anda.
                </p>
            </div>


            <!-- Tombol Kembali -->
            <div class="mb-6">
                <a 
                    href="index.php"
                    class="inline-block px-5 py-3 bg-[#E7AAB4] text-white font-semibold rounded-lg shadow hover:bg-[#d48d99] transition"
                >
                    ← Kembali ke Home
                </a>
            </div>


            <!-- Team Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="bg-white rounded-xl p-6 shadow-xl border-t-4 border-[#E7AAB4] hover:-translate-y-2 transition-all">
                    <img 
                        src="images/<?= $row['image']; ?>" 
                        class="w-32 h-32 mx-auto rounded-full object-cover mb-4 border-4 border-[#FDEEF0]"
                    >
                    <h3 class="text-xl font-semibold"><?= $row['name']; ?></h3>
                    <p class="text-[#716F7B] mt-1"><?= $row['nim']; ?></p>

                    <!-- INFO TAMBAHAN -->
                    <p class="text-sm text-gray-500 mt-3">📧 <?= $row['email']; ?></p>
                    <p class="text-sm text-gray-500">📱 <?= $row['telpon']; ?></p>

                    <?php if (!empty($row['instagram'])) { ?>
                    <a 
                        href="https://instagram.com/<?= $row['instagram']; ?>" 
                        target="_blank"
                        class="block mt-3 text-pink-500 hover:text-pink-600"
                    >
                        @<?= $row['instagram']; ?>
                    </a>
                    <?php } ?>
                </div>
                <?php } ?>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <div id="footer-placeholder"></div>

    <script src="js/script.js"></script>
</body>
</html>
