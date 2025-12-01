<?php
include "config.php";

$id = $_GET['id'];
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id='$id'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Success</title>
<style>
body { font-family: Arial; background: #f2f2f2; padding: 20px; }
.box {
    max-width: 500px; margin: auto; background: white;
    padding: 20px; border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}
a {
    background: #2a9d8f; padding: 10px 16px; color: white;
    text-decoration: none; border-radius: 6px; margin-top: 20px; display: inline-block;
}
</style>
</head>
<body>

<div class="box">
    <h2>Order Berhasil!</h2>
    <p>Nomor Order Anda:</p>
    <h1>#<?= $id ?></h1>
    <p>Total Pembayaran:</p>
    <h3>Rp <?= number_format($order['total'], 0, ',', '.') ?></h3>

    <a href="product.php">Kembali Belanja</a>
</div>

</body>
</html>
