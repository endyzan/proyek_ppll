<?php include "config.php"; ?>

<?php
if (isset($_POST['submit'])) {

    $name  = $_POST['name'];
    $price = $_POST['price'];
    $desc  = $_POST['description'];

    // Upload gambar
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    if ($image != "") {
        move_uploaded_file($tmp, "upload/" . $image);
    }

    mysqli_query($conn, "INSERT INTO product VALUES(
        '',
        '$name',
        '$price',
        '$desc',
        '$image',
        NOW()
    )");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Nama Produk</label><br>
    <input type="text" name="name" required><br><br>

    <label>Harga</label><br>
    <input type="number" name="price" required><br><br>

    <label>Deskripsi</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Gambar Produk</label><br>
    <input type="file" name="image" required><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>

</body>
</html>