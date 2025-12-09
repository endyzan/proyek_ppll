<?php
session_start();
include "config.php";

if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit;
}

$id = intval($_GET['id']);

// Jika cart belum ada, buat array kosong
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Jika produk sudah ada di cart → tambah qty
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty'] += 1;
} else {
    // Ambil data produk
    $result = mysqli_query($conn, "SELECT * FROM product WHERE id='$id'");
    $product = mysqli_fetch_assoc($result);

    // Simpan ke cart
    $_SESSION['cart'][$id] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'qty' => 1
    ];
}

// Redirect kembali ke halaman sebelumnya
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
