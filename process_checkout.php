<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    // Jika user belum login, tendang ke login
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$user_id = $_SESSION['user_id']; // <-- ambil user ID
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$total = 0;
foreach ($_SESSION['cart'] as $c) {
    $total += $c['price'] * $c['qty'];
}

// Simpan ke tabel orders
mysqli_query($conn, "INSERT INTO orders (user_id, name, phone, address, total, total_price)
                     VALUES ('$user_id', '$name', '$phone', '$address', '$total', '$total')");

$order_id = mysqli_insert_id($conn);

// Simpan order items
foreach ($_SESSION['cart'] as $item) {
    $pid = $item['id'];
    $qty = $item['qty'];
    $price = $item['price'];

    mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, qty, price)
                         VALUES ('$order_id', '$pid', '$qty', '$price')");
}

// Kosongkan cart
unset($_SESSION['cart']);

header("Location: success.php?id=" . $order_id);
exit;
