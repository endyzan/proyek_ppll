<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$id = intval($_GET['id']);

// Jika session favorite belum ada → buat array kosong
if (!isset($_SESSION['favorite'])) {
    $_SESSION['favorite'] = [];
}

// Tambahkan produk ke favorite jika belum ada
if (!in_array($id, $_SESSION['favorite'])) {
    $_SESSION['favorite'][] = $id;
}

// Kembali ke halaman sebelumnya
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
