<?php
	session_start();
	include "dbconnect.php";
	
	$formLogin = $conn->real_escape_string($_POST["formLogin"]);
	$formPassword = $conn->real_escape_string($_POST["formPassword"]);
				
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
				
	$query = "SELECT * FROM users WHERE login ='$formLogin'";
	$result = $conn->query($query);

	if ($result->num_rows == 0)
	{	
		echo "<p> User $formLogin do not exists. </p> </div>";
		include "footer.php";
		$conn->close();
		die();
	}

	$row = $result->fetch_assoc();
						
	$dbPassword = $row["password"];
								
	$passwordCheck = password_verify($formPassword, $dbPassword);
								
	if(!$passwordCheck)
	{
		echo "<p> Incorrect password. </p> </div>";
		include "footer.php";
		$conn->close();
		die();
	}	
				
	$_SESSION["userID"] = $row["ID"];
	$_SESSION["userLogin"] = $row["login"];
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
			<?php
				echo "<p> You are now logged in as a <b>$formLogin</b>. </p>";
				$conn->close();
			?>
		</div>
		
		<?php include "footer.php" ?>
		
	</body>
</html>			