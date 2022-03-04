<?php session_start();

	if(isset($_SESSION['data']))
	{
		echo $_SESSION['data'];
		unset($_SESSION['data']);
	}
	

?>

<table>
	<tr><td>Email</td><td>Role</td><td>Status</td><td>Action</td></tr>
<?php
include'db.php';
$starttime = microtime(true);

//Do your query and stuff here

$query=$conn->query(" Select users.id, users.email, roles.role_name, users.active_status from users INNER JOIN roles ON users.role_id=roles.role_id");

while($row=$query->fetch_array())
{ 
	$userid=$row['id'];
	$token=md5($userid);
	$status=$row['active_status'];
	if($status==0)
	{
		$active_status="<span style='color:green'>Active</span>";
		$action="<a href='update_profile.php?userid=$userid&&action=deactivate&&token=$token'>Click to deactivate</a>";
	}
	elseif($status==1)
	{
		$active_status="<span  style='color:red'>Inactive</span>";
		$action="<a href='update_profile.php?userid=$userid&&action=activate&&token=$token'>Click to active</a>";
	}

	?>
 	<tr>
 		<td><?= $row['email'];?></td>
 		<td><?= $row['role_name'];?></td>
 		<td> <?= $active_status;?>   </td>
 		<td><?= $action;?></td>
 	</tr>
<?php }

$endtime = microtime(true);
$duration = $endtime - $starttime;

?>
	
</table>
<h1><?= $duration;?></h1>