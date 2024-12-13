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
			<h1>Comment</h1>
			
			<?php
				
				$formLocationID = $conn->real_escape_string($_POST["formLocationID"]);
				$formUserID = $conn->real_escape_string($_POST["formUserID"]);
				$formText = $conn->real_escape_string($_POST["formText"]);
					
				if($formText == "")
				{
					echo "<p> Comment cannot be empty. </p> </div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				$query = "INSERT INTO comments (locationID, userID, text) VALUES ('$formLocationID','$formUserID','$formText')";
				
				$conn->query($query);
				$conn->close();
				
				echo "<p> Comment was added. You can view it <a href='bar.php?id=$formLocationID'>here</a>. </p>";
			?>
		
		</div>
		
		<?php include "footer.php" ?>
		
	</body>
</html>			