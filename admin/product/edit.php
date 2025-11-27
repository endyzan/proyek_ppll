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

    if ($image != "") {
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/" . $image);
        $query = "UPDATE product SET 
            name='$name',
            price='$price',
            description='$desc',
            image='$image'
            WHERE id=$id";
    } else {
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
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h2>Edit Produk</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Nama Produk</label><br>
    <input type="text" name="name" value="<?= $row['name']; ?>" required><br><br>

    <label>Harga</label><br>
    <input type="number" name="price" value="<?= $row['price']; ?>" required><br><br>

    <label>Deskripsi</label><br>
    <textarea name="description"><?= $row['description']; ?></textarea><br><br>

    <label>Gambar Saat Ini</label><br>
    <img src="upload/<?= $row['image']; ?>" width="120"><br><br>

    <label>Ganti Gambar</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="submit">Update</button>

</form>

</body>
</html>