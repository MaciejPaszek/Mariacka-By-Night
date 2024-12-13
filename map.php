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
		
		<div id="content" style="text-align: center;">
			<object id="map" type="image/svg+xml" data="Map.svg" alt="There should be an interactive map to play with."></object>
		</div>
		
		<?php include "footer.php" ?>
		
	</body>
</html>
