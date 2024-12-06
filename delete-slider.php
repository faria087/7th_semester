
<?php
include_once 'config.php';
$id = $_GET['id'];
$sql = "DELETE FROM sliders WHERE id = '$id'";
mysqli_query($conn, $sql);
header("Location: sliders.php");
?>
