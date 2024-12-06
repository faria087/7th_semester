<?php 
include_once 'config.php';
$id = $_GET['id'];
$sql = "DELETE FROM abouts WHERE id = '$id'";
mysqli_query($conn, $sql);
header("Location: abouts.php");
?>