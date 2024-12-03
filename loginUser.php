<?php
	session_start();

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
			
	$query = "SELECT * FROM MariackaByNightDB.users WHERE login ='{$formLogin}'";
	$result = $conn->query($query);

	if ($result->num_rows == 0)
	{	
		die("User $formLogin do not exists.");
		$conn->close();
	}

	$row = $result->fetch_assoc();
			
	$dbPassword = $row["password"];
					
	$passwordCheck = password_verify($formPassword, $dbPassword);
					
	if(!$passwordCheck)
	{
		die("Incorrect password.");
		$conn->close();
	}	
	
	$_SESSION["userID"] = $row["ID"];
	$_SESSION["userLogin"] = $row["login"];

	$conn->close();
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
			<?php
				if(isset($_SESSION["userLogin"]))
				{
					echo "You are now logged in as a <b>" . $_SESSION["userLogin"] . "</b>.";
				}
			?>
		</div>
		
		<?php include "footer.php" ?>
		
	</div>
</body>
</html>			