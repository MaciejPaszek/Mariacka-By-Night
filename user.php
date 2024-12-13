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
			<h1><?php echo $_SESSION["userLogin"]; ?></h1>
			<h2> Your Ratings: </h2>
			
			<?php
				$query = 	"SELECT l.id as locationID, l.name as locationName, rating FROM ratings r JOIN locations l ON r.locationID = l.ID
							WHERE userID = $_SESSION[userID] ORDER BY l.name";
				$result = $conn->query($query);
						
				while($row = $result->fetch_assoc()) {

					$locationID = $row["locationID"];
					$locationName = $row["locationName"];
					$locationRating = $row["rating"];
					echo "<p>";
					$i = 1;
					while($i <= $locationRating)
					{
						echo	"<svg height='45' width='50' id='formStar$i' onclick='starClick($i)'>";
						echo		"<polygon points='25,0 10,45 49,17 1,17, 40,45' style='fill:rgb(255,255,255,100%);'></polygon>";
						echo	"</svg> ";
						$i++;
					}
					while($i <= 5)
					{
						echo	"<svg height='45' width='50' id='formStar$i' onclick='starClick($i)'>";
						echo		"<polygon points='25,0 10,45 49,17 1,17, 40,45' style='fill:rgb(255,255,255,20%);'></polygon>";
						echo	"</svg> ";	
						$i++;
					}

					echo "<a href='/bar.php?id=$locationID'>$locationName</a></p>";
				}
			
			?>
			
			<h2> Your Comments: </h2>
			<?php
			
				$query =	"SELECT l.ID as locationID, l.name as locationName, c.ID as commentID, text, date FROM comments c JOIN locations l ON c.locationID = l.ID
							WHERE c.userID = $_SESSION[userID] ORDER BY date DESC";
				$result = $conn->query($query);
			
			
			
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
							
						$locationID			= $row["locationID"];
						$locationName		= $row["locationName"];
						$commentID			= $row["commentID"];
						$commentText		= $row["text"];
						$commentDate		= $row["date"];
						$date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $commentDate);
								
						echo	"<div class='commentBlock'>";
						echo		"<h3> <a href='/bar.php?id=$locationID#comment$commentID'>$locationName</a> <span class='commentDate'>(" . $date->format("j M Y H:i") . ")</span> </h3>";
						echo		"<p> $commentText </p>";
						echo	"</div>";
							
					} 
				}
				else
					echo "Any comments";
				
				$conn->close();
			?>
			
			<h2>Delete Account</h2>
			<p>Insert Password and press delete button</p>
			</div>
		</div>
	
		<?php include "footer.php" ?>
	
	<body>
</html>