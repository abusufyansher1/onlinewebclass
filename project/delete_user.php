<?php
session_start();
	if(isset($_GET['userid']) && $_GET['token']==md5($_GET['userid']+100) )
	{
		include'db.php';
	$userid=	$_GET['userid'];
	$query=$conn->query("delete from users where id='$userid'");
	if($query)
	{
		$_SESSION['data']="User deleted";
	}
	else{
		$_SESSION['data']="Internal Error";
	}
	header("location:show_users.php");
	}
	else{
		echo "Not authorize";	}

?>