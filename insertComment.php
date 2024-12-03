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
			<h2>Comment</h2>
			
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

				$formText = $conn->real_escape_string($_POST['formText']);
				
				if(isset($_SESSION["userID"]))
				{
					$userID = $_SESSION["userID"];
				}
				
				if(isset($_SESSION["locationID"]))
				{
					$locationID = $_SESSION["locationID"];
				}
				
				
				$query = "INSERT INTO MariackaByNightDB.comments (locationID, userID, text)
							VALUES ('{$locationID}','{$userID}','{$formText}')";
							
							
				$conn->query($query);
				$conn->close();
				
				echo "Comment was added. You can view it <a href=bar.php/id=$locationID>here</a>.";
			?>
		
		</div>
		
		<?php include "footer.php" ?>
		
	</div>
</body>
</html>			