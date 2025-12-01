<?php 
include "config.php"; 

$keyword = isset($_GET['search']) ? $_GET['search'] : "";

if ($keyword != "") {
    $sql = "SELECT * FROM product 
            WHERE name LIKE '%$keyword%' 
               OR description LIKE '%$keyword%'
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM product ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Search Result</title>
    <link rel="stylesheet" href="style.css"> <!-- opsional -->
</head>
<body>

<h2 style="margin:20px 0;">Hasil pencarian: <b><?= htmlspecialchars($keyword) ?></b></h2>

<div class="product-grid">

<?php if (mysqli_num_rows($result) === 0): ?>
    <p style="text-align:center; margin-top:20px; font-size:18px;">
        Produk "<strong><?= $keyword; ?></strong>" tidak ditemukan.
    </p>
<?php endif; ?>

<?php
if (mysqli_num_rows($query) > 0):
    while ($p = mysqli_fetch_assoc($query)):
?>
        <div class="product-card">
            <img src="uploads/<?= $p['image'] ?>" alt="<?= $p['name'] ?>" width="200">
            <h3><?= $p['name'] ?></h3>
            <p>Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
            <a href="product_detail.php?id=<?= $p['id'] ?>" class="btn">Detail</a>
        </div>
<?php
    endwhile;
else:
    echo "<p style='margin:20px 0; font-size:18px;'>Produk tidak ditemukan 🙁</p>";
endif;
?>
</div>

</body>
</html>
