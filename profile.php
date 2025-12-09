<?php
session_start();
require 'config.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$sql = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User tidak ditemukan.";
    exit;
}

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Handle upload foto
    $photoName = $user['photo']; // default tetap foto lama

    if (!empty($_FILES['photo']['name'])) {
        $fileTmp = $_FILES['photo']['tmp_name'];
        $fileName = time() . "_" . $_FILES['photo']['name'];
        $destination = "uploads/" . $fileName;

        if (!file_exists("uploads")) {
            mkdir("uploads", 0777, true);
        }

        move_uploaded_file($fileTmp, $destination);
        $photoName = $fileName;
    }

    // Update database
    $updateSql = "
        UPDATE users 
        SET address='$address', phone='$phone', photo='$photoName'
        WHERE id = $user_id
    ";

    mysqli_query($conn, $updateSql);

    header("Location: profile.php?success=1");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    font-family: 'Inter', sans-serif;
    background:#f4f6f9;
    margin:0; padding:0;
}

.profile-wrapper{
    max-width: 900px;
    margin:40px auto;
    display:flex;
    gap:30px;
}

/* ========== LEFT CARD: USER INFO ========== */
.profile-card{
    width: 32%;
    background:white;
    border-radius:14px;
    padding:25px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    text-align:center;
}

.profile-pic{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #eee;
    margin-bottom:15px;
}

.username{
    font-size:22px;
    font-weight:700;
}

.email{
    font-size:14px;
    color:#555;
    margin-bottom:20px;
}

.upload-btn{
    background:#0d6efd;
    color:white;
    display:block;
    padding:10px;
    border-radius:8px;
    margin-top:10px;
    cursor:pointer;
    font-size:14px;
}

/* ========== RIGHT CARD: FORM UPDATE ========== */
.form-card{
    width:68%;
    background:white;
    border-radius:14px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.form-card h3{
    font-size:20px;
    margin-bottom:20px;
    font-weight:600;
}

label{
    font-weight:600;
    font-size:14px;
}

input[type="text"],
input[type="file"],
input[type="email"]{
    width:100%;
    padding:12px;
    margin-top:6px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:8px;
    background:#fafafa;
}

.save-btn{
    width:100%;
    background:#28a745;
    padding:12px;
    border:none;
    color:white;
    font-size:16px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}
.save-btn:hover{
    background:#218838;
}

.logout-btn{
    display:block;
    margin-top:15px;
    padding:10px;
    background:#dc3545;
    color:white;
    font-weight:600;
    text-decoration:none;
    border-radius:8px;
    transition:0.2s;
}
.logout-btn:hover{
    background:#bb2d3b;
}

.back-btn{
    display:block;
    margin-top:15px;
    padding:10px;
    background:#828282;
    color:white;
    font-weight:600;
    text-decoration:none;
    border-radius:8px;
    transition:0.2s;
}
.back-btn:hover{
    background:#555;
}

</style>
</head>

<body>

<div class="profile-wrapper">

    <!-- LEFT PROFILE CARD -->
    <div class="profile-card">
        <img src="uploads/<?= $user['photo'] ?: 'default.png' ?>" class="profile-pic">
        
        <div class="username"><?= htmlspecialchars($user['username']) ?></div>
        <div class="email"><?= htmlspecialchars($user['email']) ?></div>

        <label class="upload-btn" for="photoInput">Ganti Foto</label>
        <input type="file" id="photoInput" name="photo" form="formUpdate" style="display:none;">
        <!-- Tombol Logout -->
        <a href="logout.php" class="logout-btn">Logout</a>
        <a href="product.php" class="back-btn">← Kembali</a>


    </div>


    <!-- RIGHT FORM CARD -->
    <div class="form-card">
        <h3>Ubah Informasi Profil</h3>

        <?php if (isset($_GET['success'])): ?>
            <p style="color:green; margin-bottom:15px;">✔ Profile berhasil diperbarui!</p>
        <?php endif; ?>

        <form id="formUpdate" action="" method="POST" enctype="multipart/form-data">
            
            <label>Alamat</label>
            <input type="text" name="address" 
                   value="<?= htmlspecialchars($user['address'] ?? '') ?>">

            <label>No. Telepon</label>
            <input type="text" name="phone" 
                   value="<?= htmlspecialchars($user['phone'] ?? '') ?>">

            <button type="submit" class="save-btn">Simpan Perubahan</button>

        </form>
    </div>

</div>

</body>
</html>
