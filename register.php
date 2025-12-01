<?php
session_start();
require 'config.php';

$err = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Cek apakah username / email sudah dipakai
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $err = "Username atau Email sudah terdaftar!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($conn, "INSERT INTO users (username, email, password) 
            VALUES ('$username', '$email', '$hash')");

        if ($query) {
            $_SESSION['success'] = "Registrasi berhasil, silakan login!";
            header("Location: login.php");
            exit;
        } else {
            $err = "Gagal mendaftar, coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>

<h2>Form Registrasi</h2>

<?php if ($err): ?>
    <p style="color:red;"><?php echo $err; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

<br>
<a href="login.php">Sudah punya akun? Login</a>

</body>
</html>
