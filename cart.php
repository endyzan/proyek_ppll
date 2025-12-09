<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .cart-container {
            max-width: 900px;
            background: white;
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-delete {
            background: #e63946;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background: #d62828;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 16px;
            background: #457b9d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn-back:hover {
            background: #1d3557;
        }

        .total-box {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Keranjang Belanja</h2>

    <?php if (!empty($_SESSION['cart'])): ?>

        <table>
            <tr>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>

            <?php 
            $grandTotal = 0;
            foreach ($_SESSION['cart'] as $item): 
                $totalPrice = $item['price'] * $item['qty'];
                $grandTotal += $totalPrice;
            ?>
            <tr>
                <td>
                    <img src="admin/product/upload/<?= $item['image']; ?>" class="product-img">
                </td>
                <td><?= $item['name']; ?></td>
                <td><?= $item['qty']; ?></td>
                <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                <td>Rp <?= number_format($totalPrice, 0, ',', '.'); ?></td>
                <td>
                    <a href="cart_delete.php?id=<?= $item['id']; ?>" class="btn-delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>

        <div class="total-box">
            Total Keseluruhan:  
            Rp <?= number_format($grandTotal, 0, ',', '.'); ?>
        </div>

    <?php else: ?>
        <p style="text-align:center; font-size:18px; color:#555;">Keranjang masih kosong.</p>
    <?php endif; ?>

    <a href="product.php" class="btn-back">← Kembali Belanja</a>
</div>

</body>
</html>
