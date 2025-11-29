<?php
include 'db.php';

// Ambil semua data dari tabel discoveries
$result = $conn->query("SELECT * FROM discoveries ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Discovery - Rekomendasi Skintone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-danger {
            background-color: #d9534f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 8px;
        }
    </style>
</head>
<body>

<h1>Data Rekomendasi Discovery</h1>

<a class="btn" href="create.php">+ Tambah Discovery Baru</a>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Undertone</th>
        <th>Depth</th>
        <th>Skin Type</th>
        <th>Recommendation</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['undertone']; ?></td>
            <td><?= $row['depth']; ?></td>
            <td><?= $row['skin_type']; ?></td>
            <td><?= substr($row['recommendation'], 0, 60) . '...'; ?></td>
            <td class="actions">
                <a class="btn" href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                <a class="btn btn-danger" 
                   href="delete.php?id=<?= $row['id']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
