<?php
	// Rozpocznij sesję
	session_start();
	
	include "dbconnect.php";
	
	// Zapytanie o nazwy barów w kolejności alfabetycznej
	$query = "SELECT * FROM locations ORDER BY name";
	$result = $conn->query($query);
	
	// Zamknij połączenie z bazą danych
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
		
			<img id="logo" src="img/Pepe Beer.png"></img>
		
			<h1>Hello There!</h1>
			<p>
				&emsp; Drinking alcohol is the most beautiful thing that can happen to a student.
				There are many occasions to drink - passing an exam, failing an exam, breakup with girlfriend or dean's hours.
				It doesn't matter what the occasion is, what matters is what to drink, where to drink and who to drink with.
				We probably won't help you find new friends or girlfriend to drink with, but at least we'll help you find the right place.
			</p>
			<p>
				&emsp; How to get started?
				Simply choose one of these fancy names from the alphabetically ordered list below or click on a random place on the map
				(I have worked very hard on this map, so go give it a try).
			</p>
			<p>
				&emsp; Don't trust your luck?
				You can always do a full review by checking the rating of the place and reading the comments about it.
				If you've already come back from the party and still remember something from yesterday, you can add your own rating and write a long comment.
				But before you start writing the story of your life, you'll have to register, because we don't want any Alcoholics Anonymous here.
			</p>
			<p>
				&emsp; Any questions or suggestions? Want to go out with us?
				Use the contact information on the bottom of this page.
				We will answer as quickly as we want, so please be patient.
			</p>
			<p>
				&emsp; <i><span id="brandName">Mariacka by Night</span> - getting drunk has never been so easy. </i>
			</p>
			
			<h1>Alphabetic order:</h1>
			<?php
				if ($result->num_rows > 0) {
					  
					echo "<ul lang='pl'>";
					  
					$lastLetter = "";
					  
					while($row = $result->fetch_assoc()) {
			
						$currentLetter = substr($row["name"], 0, 1);
						if($lastLetter != $currentLetter)
						{	
							echo 	"</ul>";
							echo	"<h2> $currentLetter </h2>";
							echo	"<ul>";
							$lastLetter = $currentLetter;
						}
						
						echo "<li> <a href='bar.php?id=$row[ID]'> $row[name] </a> </li>";
						
					}
					echo "</ul>";
				} else {
					echo "<p> There are any bars on the list. </p>";
				}
			?>
		</div>
	</div>
	
	<?php include "footer.php" ?>
	
	</body>
</html>