<?php
include "config.php";

// Pastikan ID ada
if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$id = intval($_GET['id']);
$product = mysqli_query($conn, "SELECT * FROM product WHERE id = $id");
$p = mysqli_fetch_assoc($product);

// Jika produk tidak ditemukan
if (!$p) {
    echo "<h2>Produk tidak ditemukan.</h2>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $p['name']; ?> - Detail Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            display: flex;
            gap: 40px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Left image */
        .product-image {
            flex: 1;
        }

        .product-image img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
        }

        /* Right content */
        .product-info {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .price {
            font-size: 26px;
            font-weight: bold;
            color: #e63946;
            margin: 12px 0;
        }

        .rating-wrapper ion-icon {
            color: #ffc107;
        }

        .desc {
            margin-top: 20px;
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        .btn-buy {
            margin-top: 25px;
            background: #0d6efd;
            color: #fff;
            padding: 14px 0;
            text-align: center;
            font-size: 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-buy:hover {
            background: #005ce4;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #0d6efd;
            text-decoration: none;
        }
    </style>

    <!-- ICONS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</head>
<body>

<a href="product.php" class="back">← Kembali ke Daftar Produk</a>

<div class="container">
    
    <div class="product-image">
        <img src="admin/product/upload/<?= $p['image']; ?>" alt="<?= $p['name']; ?>">
    </div>

    <div class="product-info">

        <div>
            <h1 class="product-title"><?= $p['name']; ?></h1>

            <div class="rating-wrapper">
                <?php for($i = 1; $i <= $p['rating']; $i++) { ?>
                    <ion-icon name="star"></ion-icon>
                <?php } ?>
            </div>

            <div class="price">
                Rp <?= number_format($p['price'], 0, ',', '.'); ?>
            </div>

            <p class="desc"><?= $p['description']; ?></p>
        </div>

        <a href="#" class="btn-buy">Tambah ke Keranjang</a>
    </div>

</div>

</body>
</html>
