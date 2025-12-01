<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location: favorite.php");
    exit();
}

$id = intval($_GET['id']);

if (isset($_SESSION['favorite'])) {
    $_SESSION['favorite'] = array_diff($_SESSION['favorite'], [$id]);
}

header("Location: favorite.php");
exit();
?>
