<?php
include('dbcon.php');
$id=$_GET['id'];

$delete=mysqli_query($link,"DELETE from customer where cid='$id'");
header("Location: customer.php");

?>