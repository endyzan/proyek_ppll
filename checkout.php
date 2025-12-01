<?php
session_start();
include "config.php";

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$user = null;

// Ambil data user yang sedang login
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$uid'");
    $user = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<style>
    body { font-family: Arial; background: #f2f2f2; padding: 20px; }
    .box { max-width: 500px; margin: auto; background: white; padding: 20px;
           border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    input, textarea {
        width: 100%; padding: 10px; margin: 10px 0;
        border-radius: 6px; border: 1px solid #ccc;
    }
    button {
        width: 100%; padding: 12px; background: #2a9d8f;
        border: none; border-radius: 6px; color: white;
        font-size: 16px; cursor: pointer;
    }
</style>
</head>
<body>

<div class="box">
<h2>Checkout</h2>

<form action="process_checkout.php" method="POST">

    <!-- NAME -->
    <label>Nama Lengkap</label>
    <input 
        type="text" 
        name="name" 
        value="<?= $user ? htmlspecialchars($user['username']) : '' ?>" 
        required
    >

    <!-- PHONE (jika kosong di DB, tetap kosong) -->
    <label>No. Telepon</label>
    <input 
        type="text" 
        name="phone" 
        value="<?= $user && !empty($user['phone']) ? htmlspecialchars($user['phone']) : '' ?>"
        placeholder="<?= $user && empty($user['phone']) ? 'Masukkan nomor telepon' : '' ?>"
        required
    >

    <!-- ADDRESS -->
    <label>Alamat Pengiriman</label>
    <textarea name="address" required><?= $user && !empty($user['address']) ? htmlspecialchars($user['address']) : '' ?></textarea>

    <button type="submit">Place Order</button>
</form>

</div>

</body>
</html>
