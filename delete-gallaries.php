<?php
include_once 'config.php';
$id = $_GET['id'];
$sql = "DELETE FROM gallaries WHERE id = '$id'";
mysqli_query($conn, $sql);
header("Location: gallaries.php");
?>