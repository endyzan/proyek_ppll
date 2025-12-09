<?php
include '../config.php';

$id = $_GET['id'];

$conn->query("DELETE FROM discoveries WHERE id=$id");

header("Location: index.php");
exit;
?>