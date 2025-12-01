<?php
include 'db.php';

$title = $_POST['title'];
$undertone = $_POST['undertone'];
$depth = $_POST['depth'];
$skin_type = $_POST['skin_type'];
$recommendation = $_POST['recommendation'];

$query = "INSERT INTO discoveries (title, undertone, depth, skin_type, recommendation)
VALUES ('$title', '$undertone', '$depth', '$skin_type', '$recommendation')";

$conn->query($query);

header("Location: index.php");
exit;
?>
