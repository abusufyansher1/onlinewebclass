<table>
	<tr><td>Email</td><td>Role</td></tr>
<?php
include'db.php';
$starttime = microtime(true);
$query=$conn->query("select * from users where active_status='0'");

while($row=$query->fetch_array())
{
	$role_id=$row['role_id'];

$row_roles=$conn->query("select role_name AS role from roles where role_id='$role_id' limit 1")->fetch_array();

	?>
		<tr>
			<td><?php echo $row['email'];?></td>

			<td><?php echo $row_roles['role'];?> </td>
		</tr>
	<?php
}
$endtime = microtime(true);
$duration = $endtime - $starttime;
?>
	
</table>
<h1><?= $duration;?></h1>