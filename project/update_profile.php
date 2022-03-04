<?php
session_start();
include'db.php';

if(isset($_GET['action']) && !empty($_GET['userid']) && !empty($_GET['action']) 
	&& $_GET['token']==md5($_GET['userid']))
{
	$userid=$_GET['userid'];
	if($_GET['action']=="activate")
	{
	$query=$conn->query("update users set active_status=0 where id='$userid'");
		
	}
	elseif($_GET['action']=="deactivate")
	{
	$query=$conn->query("update users set active_status=1 where id='$userid'");	
	}
	else
	{

	}

	if($query)
		{
			$_SESSION['data']="Data updated";
		}
		else
		{
			$_SESSION['data']="Updation failed";
		}
	header("location:join_query.php");		

}
else
{
	
}



?>