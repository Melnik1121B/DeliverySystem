<?php
include '../includes/db.php';
error_reporting(0);
session_start();


// sending query
mysqli_query($db,"DELETE FROM restaurant WHERE rs_id = '".$_GET['res_del']."'");
header("location:allrestraunt.php");  

?>
