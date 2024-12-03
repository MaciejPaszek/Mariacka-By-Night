<?php
	session_start();
	session_unset();
	session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"></meta>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Mariacka By Night</title>
	</head>
	
	<body>
		<?php include "header.php" ?>
		
		<div id="content">
			<h2>Logout</h2>
			You are now logged out.
		</div>
		
		<?php include "footer.php" ?>
		
	</div>
</body>
</html>			