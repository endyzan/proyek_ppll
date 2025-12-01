<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$order_id = $_GET['id'];

// --- Ambil data order ---
$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    echo "Order tidak ditemukan.";
    exit;
}

// --- Ambil data item ---
$stmt2 = $conn->prepare("
    SELECT oi.*, p.name, p.image 
    FROM order_items oi
    JOIN product p ON p.id = oi.product_id
    WHERE oi.order_id = ?
");
$stmt2->bind_param("i", $order_id);
$stmt2->execute();
$items = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Pesanan</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        img { width: 60px; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #ccc; vertical-align: middle; }
        h2 { margin-bottom: 8px; }
    </style>
</head>
<body>

<h2>Detail Pesanan #<?= $order_id ?></h2>
<p><b>Status:</b> <?= $order['status'] ?></p>
<p><b>Tanggal:</b> <?= $order['created_at'] ?></p>

<table>
    <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <img src="admin/product/upload/<?= $item['image'] ?>"> 
            <?= $item['name'] ?>
        </td>
        <td><?= $item['qty'] ?></td>
        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
        <td>Rp <?= number_format($item['qty'] * $item['price'], 0, ',', '.') ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<p><b>Total: Rp <?= number_format($order['total_price'], 0, ',', '.') ?></b></p>

</body>
</html>
