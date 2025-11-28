<?php 
    include "config.php"; 
    $result = mysqli_query($conn, "SELECT * FROM product ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <style>
        body {
            font-family: Arial;
            background: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
            padding: 10px;
        }
        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 12px;
        }
        .name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .desc {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }
        .price {
            font-size: 17px;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<h2>Daftar Produk</h2>

<div class="grid">

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="card">
        <img src="admin/product/upload/<?= $row['image']; ?>" alt="">
        <div class="name"><?= $row['name']; ?></div>
        <div class="desc"><?= $row['description']; ?></div>
        <div class="price">Rp <?= number_format($row['price'], 0, ',', '.'); ?></div>
    </div>
<?php } ?>

</div>

</body>
</html>
