<?php 
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];
$mobile=$_REQUEST['mobile'];
$gender=$_REQUEST['gender'];
$qualification= implode(",", $_POST['qualification']);

$pic=$_FILES["pic"]["tmp_name"];
$destination="image/".$_FILES["pic"]["name"];
if(move_uploaded_file($pic, $destination))
{
	$pic=$_FILES["pic"]["name"];
}

$country=$_REQUEST['country'];

$con=mysqli_connect("localhost","root","","ajax");
$qry=mysqli_query($con,"insert into user(name,email,password,mobile,gender,qualification,pic,country) values('$name','$email','$password','$mobile','$gender','$qualification','$pic','$country')");

?>