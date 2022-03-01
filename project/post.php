<?php
session_start();
include'db.php';
//recieve
$email=$_POST['email'];
$password=md5($_POST['pass']);

$role=$_POST['role'];


$query="insert into users(email,password,role_id) values('$email','$password','$role')";
$insert_query=$conn->query($query);

// $insert_query=$conn->query("
// 	insert into users(email,password,role) 
// 	values('$email','$password','$role')
// 	");

if($insert_query)
{
	$_SESSION['data']="Data uploaded";
	// redirect
	header('location:index.php');
}
else{
	$_SESSION['data']="Data uploading failed: ".$conn->error;
	// redirect
	header('location:index.php');
}




?>