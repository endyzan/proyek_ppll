<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Favorite</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .cart-container {
            max-width: 900px;
            background: white;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th {
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
        }

        table th, table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            vertical-align: middle;
        }

        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        /* --- PERBAIKAN CSS TOMBOL --- */
        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px; /* Jarak antar tombol */
            flex-wrap: wrap; /* Agar responsif di layar kecil */
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            white-space: nowrap; /* Mencegah teks tombol turun ke bawah */
        }

        .btn-cart {
            background: #2a9d8f;
            color: white;
            border: 1px solid #2a9d8f;
        }

        .btn-cart:hover {
            background: #1f776e;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(42, 157, 143, 0.3);
        }

        .btn-delete {
            background: white;
            color: #e63946;
            border: 1px solid #e63946;
        }

        .btn-delete:hover {
            background: #e63946;
            color: white;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: #457b9d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background: #1d3557;
        }
        
        .empty-msg {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Daftar Favorite</h2>

    <?php
    $favorites = isset($_SESSION['favorite']) ? $_SESSION['favorite'] : [];

    if (!empty($favorites)):
        // Pastikan ID aman dari SQL Injection sederhana (hanya angka)
        $clean_ids = array_map('intval', $favorites);
        $ids = implode(",", $clean_ids);
        
        // Cek jika ID valid ada sebelum query
        if(!empty($ids)) {
            $result = mysqli_query($conn, "SELECT * FROM product WHERE id IN ($ids)");
        } else {
            $result = false;
        }
        
        if ($result && mysqli_num_rows($result) > 0):
    ?>

        <table>
            <thead>
                <tr>
                    <th width="15%">Gambar</th>
                    <th width="35%">Produk</th>
                    <th width="20%">Harga</th>
                    <th width="30%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <img src="admin/product/upload/<?= htmlspecialchars($item['image']); ?>" class="product-img" alt="Produk">
                    </td>
                    <td style="font-weight: bold; color: #333;"><?= htmlspecialchars($item['name']); ?></td>
                    <td style="color: #2a9d8f; font-weight: bold;">Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="cart_add.php?id=<?= $item['id']; ?>" class="btn btn-cart">
                                + Keranjang
                            </a>
                            <a href="favorite_delete.php?id=<?= $item['id']; ?>" class="btn btn-delete" onclick="return confirm('Hapus dari favorite?')">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php 
        else: 
            echo '<div class="empty-msg">Data produk tidak ditemukan.</div>';
        endif;
    else: 
    ?>
        <div class="empty-msg">
            <p style="font-size:18px;">Favorite masih kosong.</p>
            <p>Silahkan cari produk yang Anda suka.</p>
        </div>
    <?php endif; ?>

    <a href="product.php" class="btn-back">← Kembali Belanja</a>
</div>

</body>
</html>