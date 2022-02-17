<?php
include'db.php';
//recieve
$email=$_POST['email'];
$password=md5($_POST['pass']);

$role=$_POST['role'];

$insert_query=$conn->query("insert into users(email,password,role) values('$email','$password','$role')");
if($insert_query)
{
	header('location:index.php');
}
else{
 echo "failed".$conn->error;
}




?>