<?php
// include db connection
	include 'db.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="post.php" method="post">
		<label>Email</label>
		<input type="email" name="email" required>
		<br>
		<label>Password</label>
		<input type="password" name="pass" required="">
<br>
		<label>Select Role</label>
		<select name="role" required="">
			<option value='1'>Admin</option>
			<option value='2'>Faculty</option>
			<option value='3'>Student</option>
		</select>
		<br>
		<input type="submit" name="submit" value="Save">
	</form>

</body>
</html>