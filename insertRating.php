<?php
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
			<h1>Rating</h1>
			
			<?php
				$formUserID = $conn->real_escape_string($_POST['formUserID']);
				$formLocationID = $conn->real_escape_string($_POST['formLocationID']);
				$formRating = $conn->real_escape_string($_POST['formRating']);
				
				// Usuń poprzednie oceny tego użytkownika
				$query = "DELETE FROM ratings WHERE locationID = $formLocationID AND userID = $formUserID";
				$conn->query($query);
				
				// Wstaw nową ocenę tego użytkownika
				$query = "INSERT INTO ratings (locationID, userID, rating)
							VALUES ('{$formLocationID}','{$formUserID}','{$formRating}')";		
				$conn->query($query);
				
				
				$conn->close();
				
				echo "Rate was added. You can view it <a href=bar.php?id=$formLocationID>here</a>.";
			?>
		
		</div>
		
		<?php include "footer.php" ?>
		
	</body>
</html>			