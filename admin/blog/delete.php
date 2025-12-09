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
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Ambil data blog untuk cek gambar
$q = mysqli_query($conn, "SELECT * FROM sharing WHERE id='$id'");
$blog = mysqli_fetch_assoc($q);

if ($blog) {
    // Hapus gambar jika ada
    if (!empty($blog['gambar']) && file_exists("../../assets/uploads/sharing/" . $blog['gambar'])) {
        unlink("../../assets/uploads/sharing/" . $blog['gambar']);
    }

    // Hapus row dari database
    mysqli_query($conn, "DELETE FROM sharing WHERE id='$id'");
}

header("Location: index.php");
exit();
