<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Discovery</title>
</head>
<body>

<h1>Tambah Data Discovery</h1>

<form action="store.php" method="POST">

    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Undertone:</label><br>
    <select name="undertone" required>
        <option value="warm">Warm</option>
        <option value="cool">Cool</option>
        <option value="neutral">Neutral</option>
    </select><br><br>

    <label>Depth:</label><br>
    <select name="depth" required>
        <option value="light">Light</option>
        <option value="medium">Medium</option>
        <option value="deep">Deep</option>
    </select><br><br>

    <label>Skin Type:</label><br>
    <select name="skin_type" required>
        <option value="normal">Normal</option>
        <option value="dry">Dry</option>
        <option value="oily">Oily</option>
        <option value="combination">Combination</option>
        <option value="sensitive">Sensitive</option>
    </select><br><br>

    <label>Recommendation:</label><br>
    <textarea name="recommendation" rows="5" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>
