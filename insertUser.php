<?php
	// Rozpocznij sesję
	session_start();
	include "dbconnect.php";
	
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
			<h1>Register</h1>
			
			<?php
				
				$formLogin = $conn->real_escape_string($_POST["formLogin"]);
				$formPassword = $conn->real_escape_string($_POST["formPassword"]);
				$formRepeatPassword = $conn->real_escape_string($_POST["formRepeatPassword"]);
				
				if ($formLogin == "")
				{
					echo "<p> Login cannot be empty. </p> </div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				if ($formPassword == "")
				{
					echo "<p> Password cannot be empty. </p> </div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				if(strlen($formPassword) < 8)
				{
					echo "<p> Password must be at least 8 characters long. </p> </div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				if ($formPassword != $formRepeatPassword)
				{
					echo "<p> Inserted passwords don't match. </p> </div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				
				$query = "SELECT * FROM users WHERE login = '$formLogin'";
				$result = $conn->query($query);

				if ($result->num_rows > 0)
				{
					echo "<p> User <b>$formLogin</b> already exists. Please use another login. </p> </div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				$hash = password_hash($formPassword, PASSWORD_BCRYPT);
				
				$query = "INSERT INTO users (login, password) VALUES ('$formLogin','$hash')";

				$conn->query($query);
				$conn->close();
				
				echo "<p> You are now registered as <b>$formLogin</b>. Visit the <a href='/login.php'><b>Login</b></a> page to use your new user privileges. And don't forget your password, because there is no retrive system yet. </p>";
			?>
		
		</div>
		
		<?php include "footer.php" ?>

	</body>
</html>			