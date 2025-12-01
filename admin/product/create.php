<?php include "config.php"; ?>

<?php
if (isset($_POST['submit'])) {

    $name  = $_POST['name'];
    $price = $_POST['price'];
    $desc  = $_POST['description'];
    $rating = $_POST['rating'];

    // Upload gambar
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    if ($image != "") {
        move_uploaded_file($tmp, "../../images/" . $image);
    }

    mysqli_query($conn, 
        "INSERT INTO product (name, price, description, image, rating)
         VALUES ('$name', '$price', '$desc', '$image', '$rating')"
    );

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>

    <style>
        body {font-family: Arial; background:#f4f6f9; padding:20px;}
        .container {max-width:600px; margin:auto; background:white; padding:25px; border-radius:8px;}
        input, textarea, select {width:100%; padding:12px; margin-bottom:18px; border-radius:6px;}
        button {width:100%; padding:12px; background:#0d6efd; color:white; border-radius:6px;}
    </style>
</head>

<body>

<div class="container">
    <h2>➕ Tambah Produk</h2>

    <form method="POST" enctype="multipart/form-data">
        
        <label>Nama Produk</label>
        <input type="text" name="name" required>

        <label>Harga</label>
        <input type="number" name="price" required>

        <label>Rating</label>
        <select name="rating">
            <option value="5">5 ⭐</option>
            <option value="4">4 ⭐</option>
            <option value="3">3 ⭐</option>
        </select>

        <label>Deskripsi</label>
        <textarea name="description" required></textarea>

        <label>Gambar Produk</label>
        <input type="file" name="image" required>

        <button type="submit" name="submit">Simpan Produk</button>
    </form>
    
    <a href="index.php" class="back-btn">Kembali ke Daftar Produk</a>
</div>

</body>
</html>
