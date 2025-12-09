<?php
session_start();
include "../../config.php";

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// CEK ID
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];

// Ambil data anggota untuk mendapatkan nama file gambar
$getData = mysqli_query($conn, "SELECT * FROM team WHERE id = '$id'");
$data = mysqli_fetch_assoc($getData);

if (!$data) {
    die("Data tidak ditemukan!");
}

// Hapus gambar jika ada
$imagePath = "../../images/" . $data['image'];
if (file_exists($imagePath) && is_file($imagePath)) {
    unlink($imagePath);
}

// Hapus data dari database
$query = mysqli_query($conn, "DELETE FROM team WHERE id = '$id'");

if ($query) {
    echo "<script>
            alert('Anggota berhasil dihapus!');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus anggota!');
            window.location.href = 'index.php';
          </script>";
}
?>
