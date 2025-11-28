<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>

    <style>
        body {font-family: Arial; background:#f4f6f9; padding:20px;}
        h2 {color:#333;}
        .btn {padding:10px 15px; background:#28a745; color:white; border-radius:5px; text-decoration:none;}
        table {width:100%; border-collapse:collapse; background:white; box-shadow:0 3px 10px rgba(0,0,0,0.1);}
        th {background:#0d6efd; color:white; padding:12px;}
        td {padding:12px; border-bottom:1px solid #eee;}
        img {width:90px; height:90px; object-fit:cover; border-radius:8px;}
        .btn-edit {background:#007bff; padding:6px 12px; color:white; border-radius:4px; text-decoration:none;}
        .btn-delete {background:#dc3545; padding:6px 12px; color:white; border-radius:4px; text-decoration:none;}
    </style>
</head>

<body>

<h2>📦 Daftar Produk</h2>
<a href="create.php" class="btn">+ Tambah Produk</a>

<table>
    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Rating</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM product ORDER BY id DESC");
    $no = 1;

    while ($row = mysqli_fetch_assoc($query)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>

        <!-- Folder gambar berada di ../images/ -->
        <td><img src="../../images/<?= $row['image']; ?>"></td>

        <td><b><?= $row['name']; ?></b></td>
        <td><b>Rp <?= number_format($row['price']); ?></b></td>
        <td><?= $row['rating']; ?> ⭐</td>
        <td style="text-align:left;"><?= $row['description']; ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
            <a href="delete.php?id=<?= $row['id']; ?>" class="btn-delete"
                onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>