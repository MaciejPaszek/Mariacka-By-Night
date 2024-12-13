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
			<h1>Login</h1>
			<form action="loginUser.php" method="post">
			
				<label for="formLogin"> <h3 class="center">Login:</h3>
					<input id="formLogin" type="text" name="formLogin" maxlength="50"></input> <br>
				</label>
				
				<label for="formPassword"> <h3 class="center">Password:</h3>
					<input id="formPassword" type="password" name="formPassword" maxlength="50"></input> <br>
				</label>
				
				<button id="login" type="submit" >Log Me In</button>
			</form>
		</div>	
	
		<?php include "footer.php" ?>
	
	</body>
</html>	