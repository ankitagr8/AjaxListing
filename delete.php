<?php 
$id=$_REQUEST['id'];
$con=mysqli_connect("localhost","root","","ajax");
$qry=mysqli_query($con,"delete from user where id='$id'");
session_start();
$_SESSION['delete_message']="Data Delete successfully";
header("location:index.php");
?>