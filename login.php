<?php
session_start();
require 'config.php';

$err = "";

// Jika tombol login ditekan
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);

        // Cek password
        if (password_verify($password, $row['password'])) {

            // Simpan session
            $_SESSION['user_id']  = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = $row['role'];

            // Cek role
            if ($row['role'] === 'admin') {
                header("Location: admin/index.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }

        } else {
            $err = "Password salah!";
        }
    } else {
        $err = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }
        .box {
            width: 350px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
            display: block;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="box">
    <h2 style="text-align:center;">Login</h2>

    <?php if ($err): ?>
        <p style="color:red; text-align:center;"><?php echo $err; ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <a href="register.php">Belum punya akun? Register di sini</a>
</div>

</body>
</html>
