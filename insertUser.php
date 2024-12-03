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
		
		<script>
		
		</script>
		
	</head>
	
	<body>
		<?php include "header.php" ?>
		
		<div id="content">
			<h2>Register</h2>
			
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "MariackaByNightDB";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}

				$formLogin = $conn->real_escape_string($_POST['formLogin']);
				$formPassword = $conn->real_escape_string($_POST['formPassword']);
				$formRepeatPassword = $conn->real_escape_string($_POST['formRepeatPassword']);
				
				if ($formPassword == "")
					  die("Password cannot be empty.");
				
				if ($formPassword != $formRepeatPassword)
					  die("Inserted passwords don't match.");
				
				$query = "SELECT * FROM MariackaByNightDB.users WHERE login ='{$formLogin}'";
				$result = $conn->query($query);

				if ($result->num_rows > 0)
					  die("User <b>$formLogin</b> already exists. Please use another login.");
				
				$hash = password_hash($formPassword, PASSWORD_BCRYPT);
				
				$query = "INSERT INTO MariackaByNightDB.users (login, password)
							VALUES ('{$formLogin}','{$hash}')";

				$conn->query($query);
				$conn->close();
				
				echo "You are now registered as <b>$formLogin</b>. Visit the <b>LOGIN</b> page to use your user privileges. And dont forget your password, because there is no retrive system yet.";
			?>
		
		</div>
		
		<?php include "footer.php" ?>
		
	</div>
</body>
</html>			