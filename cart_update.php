<?php
session_start();

if (!isset($_GET['id']) || !isset($_GET['action'])) {
    header("Location: cart.php");
    exit;
}

$id = intval($_GET['id']);
$action = $_GET['action'];

if (isset($_SESSION['cart'][$id])) {

    if ($action == "plus") {
        $_SESSION['cart'][$id]['qty'] += 1;
    }

    if ($action == "minus") {
        $_SESSION['cart'][$id]['qty'] -= 1;

        // Jika qty <= 0, hapus dari cart
        if ($_SESSION['cart'][$id]['qty'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
}

header("Location: cart.php");
exit;
