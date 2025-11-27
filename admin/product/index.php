<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top:20px; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #000; color:#fff; }
        img { width: 80px; border-radius: 5px; }
        .btn { padding:6px 12px; background:#28a745; color:#fff; text-decoration:none; border-radius:4px; }
        .btn-edit { background:#007bff; color:white; padding:5px 10px; border-radius:4px; text-decoration:none; }
        .btn-delete { background:#dc3545; color:white; padding:5px 10px; border-radius:4px; text-decoration:none; }
    </style>
</head>
<body>

<h2>Daftar Produk</h2>
<a href="create.php" class="btn">+ Tambah Produk</a>

<table>
    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Harga</th>
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
        <td><img src="upload/<?= $row['image']; ?>"></td>
        <td><?= $row['name']; ?></td>
        <td>Rp <?= number_format($row['price']); ?></td>
        <td><?= $row['description']; ?></td>
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