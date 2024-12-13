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
				//$formText = "Komentarz pierwszy jest najważniejszy.";
				//$formText = "Komentarz drugi jest niezbyt długi.";
				//$formText = "Komentarz trzeci do bazy leci.";
				$formText = "Komentarz czwarty jest niewiele warty.";
				
				$userID = 1;
					
				for($locationID = 1; $locationID <= 24; $locationID++)
				{
					$query = "INSERT INTO comments (locationID, userID, text)
								VALUES ('{$locationID}','{$userID}','{$formText}')";
								
					$conn->query($query);
					
				}
				
				$conn->close();
				echo "Comment was added. You can view it <a href=bar.php?id=$locationID>here</a>.";
			?>
		
		</div>
		
		<?php include "footer.php" ?>
		
	</body>
</html>			