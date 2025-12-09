<?php
session_start();
include "../../config.php";

// CEK ROLE ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$id        = $_POST['id'];
$name      = $_POST['name'];
$nim       = $_POST['nim'];
$email     = $_POST['email'];
$instagram = $_POST['instagram'];
$telpon    = $_POST['telpon'];

// Ambil data lama di database (untuk gambar lama)
$stmt = $conn->prepare("SELECT image FROM team WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$oldData = $res->fetch_assoc();
$stmt->close();

$oldImage = $oldData['image'];
$newImage = $oldImage; // default: tidak ganti gambar

// ===============================
// HANDLE UPLOAD GAMBAR (JIKA ADA)
// ===============================
if (!empty($_FILES['image']['name'])) {

    $fileName = $_FILES['image']['name'];
    $tmpName  = $_FILES['image']['tmp_name'];

    $allowedExt = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) {
        echo "Format file tidak diizinkan! Gunakan JPG atau PNG.";
        exit();
    }

    // Buat nama file unik
    $newImage = time() . "_" . rand(1000, 9999) . "." . $ext;

    $uploadPath = "../../images/" . $newImage;

    // Upload file
    if (move_uploaded_file($tmpName, $uploadPath)) {

        // Hapus file lama jika ada
        if (!empty($oldImage) && file_exists("../../images/" . $oldImage)) {
            unlink("../../images/" . $oldImage);
        }

    } else {
        echo "Gagal upload file!";
        exit();
    }
}

// ===============================
// UPDATE DATA
// ===============================

$stmt = $conn->prepare("UPDATE team SET name=?, nim=?, email=?, instagram=?, telpon=?, image=? WHERE id=?");
$stmt->bind_param("ssssssi", $name, $nim, $email, $instagram, $telpon, $newImage, $id);

if ($stmt->execute()) {
    header("Location: index.php?status=updated");
    exit();
} else {
    echo "Terjadi kesalahan saat update data.";
}

$stmt->close();
$conn->close();
?>
