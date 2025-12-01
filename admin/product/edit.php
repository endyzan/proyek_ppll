<?php include "config.php"; ?>

<?php
$id  = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM product WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {

    $name  = $_POST['name'];
    $price = $_POST['price'];
    $desc  = $_POST['description'];

    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    // Jika user mengganti gambar
    if ($image != "") {

        // folder penyimpanan gambar yg benar
        $path = "../../images/" . $image;

        move_uploaded_file($tmp, $path);

        $query = "UPDATE product SET 
            name='$name',
            price='$price',
            description='$desc',
            image='$image'
            WHERE id=$id";

    } else {
        // tanpa ganti gambar
        $query = "UPDATE product SET 
            name='$name',
            price='$price',
            description='$desc'
            WHERE id=$id";
    }

    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .current-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #0d6efd;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #084298;
        }

        .back-btn {
            display: block;
            margin-top: 15px;
            text-align: center;
            padding: 10px;
            background: #6c757d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #5a6268;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>✏️ Edit Produk</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Nama Produk</label>
        <input type="text" name="name" value="<?= $row['name']; ?>" required>

        <label>Harga</label>
        <input type="number" name="price" value="<?= $row['price']; ?>" required>

        <label>Deskripsi</label>
        <textarea name="description" required><?= $row['description']; ?></textarea>

        <label>Gambar Saat Ini</label>
        <img src="../../images/<?= $row['image']; ?>" class="current-img">

        <label>Ganti Gambar (Opsional)</label>
        <input type="file" name="image">

        <button type="submit" name="submit">Update Produk</button>
    </form>

    <a href="index.php" class="back-btn">Kembali ke Daftar Produk</a>
</div>

</body>
</html>