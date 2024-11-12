<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"></meta>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Mariacka By Night &trade;</title>
	</head>
	
	<body>
		<p id="title">
			Mariacka By Night	&trade;
		</p>
		
		<nav>
			<a href="index.php">
				<div id="list" class="navigator">LIST</div>
			</a>
			<a href="map.php">
				<div id="map" class="navigator">MAP</div>
			</a>
			<a href="register.php">
				<div id="register" class="navigator">REGISTER</div>
			</a>
			<a href="login.php">
				<div id="login" class="navigator">LOGIN</div>
			</a>
		</nav>
		
		<div id="content">
		
			<img id="photo" src="img/Pepe Beer.png"></img>
		
			<h2>Hello There!</h2>
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
				&emsp; <i><span class="brandName">Mariacka by Night &trade;</span> - getting drunk has never been so easy. </i>
			</p>
			
			<h2>Alphabetic order:</h2>
			<ul>
			
				<?php
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "MariackaByNight";
					
					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					  die("Connection failed: " . $conn->connect_error);
					}

					$sql = "SELECT * FROM MariackaByNight.bary ORDER BY nazwa";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  
					  $lastLetter = "";
					  
					  while($row = $result->fetch_assoc()) {
						//echo "id: " . $row["id"]. " - Name: " . $row["nazwa"]. " " . $row["adres"]. "<br>";
						$currentLetter = substr($row["nazwa"], 0, 1);
						if($lastLetter != $currentLetter)
						{	
							echo '</ul><h3>' . $currentLetter . '</h3><ul>';
							$lastLetter = $currentLetter;
						}
					
						echo '<li><a href="bar.php?id=' . $row["id"] . '">' . $row["nazwa"] . '</a></li>';
					  }
					} else {
					  echo "0 results";
					}
					$conn->close();
				?>
			</ul>
			
		</div>
		
		<footer>
			<p>Authors: Section 321</p>
			<p>A. A. Barczyk - <a href="mailto:ab306198@student.polsl.pl">ab306198@student.polsl.pl</a></p>
			<p>M. R. Paszek -  <a href="mailto:mp306395@student.polsl.pl">mp306395@student.polsl.pl</a></p>
		</footer>
		
	</div>
</body>
</html>