<?php
	session_start();
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
			<h2>Login</h2>
			<form action="loginUser.php" method="post">
			
				<label for="formLogin">Login: </label><br>
				<input id="formLogin" type="text" name="formLogin"></input><br><br>
				
				<label for="formPassword">Password: </label><br>
				<input id="formPassword" type="password" name="formPassword"></input> <br><br>
				
				<button id="login" type="submit" >Log Me In</button>
			</form>
		</div>	
	
	<?php include "footer.php" ?>
	
</body>
</html>	