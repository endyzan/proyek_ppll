<?php
include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$undertone = $_POST['undertone'];
$depth = $_POST['depth'];
$skin_type = $_POST['skin_type'];
$recommendation = $_POST['recommendation'];

$query = "UPDATE discoveries SET 
    title='$title',
    undertone='$undertone',
    depth='$depth',
    skin_type='$skin_type',
    recommendation='$recommendation'
    WHERE id=$id";

$conn->query($query);

header("Location: index.php");
exit;
?>
