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
			<h2>Register</h2>
			<form action="insertUser.php" method="post">
			
				<label for="formLogin">Login: </label><br>
				<input id="formLogin" type="text" name="formLogin" maxlength="50"></input><br><br>
				
				<label for="formPassword">Password: </label><br>
				<input id="formPassword" type="password" name="formPassword" maxlength="50"></input> <br><br>

				<label for="formRepeatPassword">Repeat password: </label> <br>
				<input id="formRepeatPassword" type="password" name="formRepeatPassword" maxlength="50"></input> <br><br>
				
				<button id="register" type="submit" >Register Me</button>
				
			</form>
			
			
		</div>
		
		<?php include "footer.php" ?>
	</div>
</body>
</html>			