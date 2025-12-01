<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pesanan Saya</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border-bottom: 1px solid #ccc; text-align: left; }
        .status { padding: 6px 12px; border-radius: 6px; color: #fff; }
        .Pending { background: orange; }
        .Diproses { background: blue; }
        .Dikirim { background: purple; }
        .Selesai { background: green; }
        .Dibatalkan { background: red; }
        a.btn { padding: 5px 12px; background: black; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

<h2>Daftar Pesanan Saya</h2>

<?php if (count($orders) == 0): ?>
    <p>Belum ada pesanan.</p>
<?php else: ?>
<table>
    <tr>
        <th>ID Pesanan</th>
        <th>Tanggal</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($orders as $o): ?>
    <tr>
        <td>#<?= $o['id'] ?></td>
        <td><?= $o['created_at'] ?></td>
        <td>Rp <?= number_format($o['total_price'], 0, ',', '.') ?></td>
        <td><span class="status <?= $o['status'] ?>"><?= $o['status'] ?></span></td>
        <td><a class="btn" href="order_detail.php?id=<?= $o['id'] ?>">Detail</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>
