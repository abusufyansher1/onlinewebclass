<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- //swtich -->
	<?php
	$a=10;
	$b=20;
	$c="mul";

	switch ($c)
	{
		case "mul":
			echo $a*$b;
		break;
		case "add":
			echo $a+$b;
		break;
		case "div":
			echo $a/$b;
		break;
		case "sub":
			echo $a-$b;
		break;
		default:
		echo "NO CASE IS FOUND";



	}




	?>

</body>
</html>