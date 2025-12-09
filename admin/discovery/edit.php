<?php
include '../../config.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM discoveries WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Discovery</title>
</head>
<body>

<h1>Edit Data Discovery</h1>

<form action="update.php" method="POST">

    <input type="hidden" name="id" value="<?= $data['id']; ?>">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?= $data['title']; ?>" required><br><br>

    <label>Undertone:</label><br>
    <select name="undertone">
        <option value="warm" <?= $data['undertone']=='warm'?'selected':'' ?>>Warm</option>
        <option value="cool" <?= $data['undertone']=='cool'?'selected':'' ?>>Cool</option>
        <option value="neutral" <?= $data['undertone']=='neutral'?'selected':'' ?>>Neutral</option>
    </select><br><br>

    <label>Depth:</label><br>
    <select name="depth">
        <option value="light" <?= $data['depth']=='light'?'selected':'' ?>>Light</option>
        <option value="medium" <?= $data['depth']=='medium'?'selected':'' ?>>Medium</option>
        <option value="deep" <?= $data['depth']=='deep'?'selected':'' ?>>Deep</option>
    </select><br><br>

    <label>Skin Type:</label><br>
    <select name="skin_type">
        <option value="normal" <?= $data['skin_type']=='normal'?'selected':'' ?>>Normal</option>
        <option value="dry" <?= $data['skin_type']=='dry'?'selected':'' ?>>Dry</option>
        <option value="oily" <?= $data['skin_type']=='oily'?'selected':'' ?>>Oily</option>
        <option value="combination" <?= $data['skin_type']=='combination'?'selected':'' ?>>Combination</option>
        <option value="sensitive" <?= $data['skin_type']=='sensitive'?'selected':'' ?>>Sensitive</option>
    </select><br><br>

    <label>Recommendation:</label><br>
    <textarea name="recommendation" rows="5" required><?= $data['recommendation']; ?></textarea><br><br>

    <button type="submit">Update</button>

</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>