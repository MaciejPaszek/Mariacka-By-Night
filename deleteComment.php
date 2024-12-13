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
				$formCommentID = $conn->real_escape_string($_POST['formCommentID']);
				$formLocationID = $conn->real_escape_string($_POST['formLocationID']);
				
				$query = "DELETE FROM comments WHERE id = $formCommentID";
									
				$conn->query($query);
				$conn->close();
				
				echo "<p> Comment was deleted. You can view it <a href=bar.php?id=$formLocationID>here</a>. </p>";
			?>
		
		</div>
		
		<?php include "footer.php" ?>
		
	</body>
</html>			