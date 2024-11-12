<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"></meta>
		<link rel="stylesheet" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Mariacka By Night</title>
	</head>
	
	<body>
	
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

			$sql = "SELECT * FROM MariackaByNight.bary WHERE id = " . $_GET["id"];
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				
				$row = $result->fetch_assoc();
				
				$barName		= $row["nazwa"];
				$barAdress		= $row["adres"];
				$barOpenHours	= $row["godziny"];
				$barSocial		= $row["linki"];
				$barDesc		= $row["opis"];
				$barImage		= 'img/' . $row["zdjecie"];
			  // output data of each row
			  //while($row = $result->fetch_assoc()) {
				//echo "id: " . $row["id"]. " - Name: " . $row["nazwa"]. " " . $row["adres"]. "<br>";
				//$variablename = $row["id"];
			  //}
			} else {
			  echo "0 results";
			}
			
			$conn->close();
		?>
	
		<p id="title">
			Mariacka By Night
		</p>
		
		<nav>
			<a href="list.php">
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
		
			<img id="photo" src="<?php echo $barImage; ?>" alt= "<?php echo "Tu powinna być forografia lokalu " . $barName; ?>" ></img>
		
			<div id="infoSection">
				<h1 id="barName"> <?php echo $barName; ?> </h1>
				<h3 id="barAdress"> <?php echo $barAdress; ?> </h3>
				<h3 id="barOpenHours"> <?php echo $barOpenHours; ?> </h3>
				<h3 id="barRating">&#9733 &#9733 &#9733 &#9733 &#9734 4.3 (32 ratings)</h3>
				<h3 id="barSocial"><a href="<?php echo $barSocial; ?>"> <?php echo $barSocial; ?> </a></h3>
			</div>
			
			<div id="descriptionSection">
				<h2>Description</h2>
				<p id="barDesc">
					<?php echo $barDesc; ?>	
				</p>
			</div>
			
			<div id="commentSection">
			
				<h2>Comments</h2>
				
				<p>You must be logged in to write comments and rate.</p>
				
				<div class="commentBlock">
					<form>
						<h3>Your Username</h3>
						<textarea type="text" placeholder="Write comment..."></textarea>
						<button id="commentSend" type="submit" value="Add comment"></button>
					</form>
				</div>
				
				<div class="commentBlock">
					<h3>BritishSinger <span class="commentDate">24.10.2024</span> </h3>
					<p>Never gonna give you up. Never gonna let you down.</p>
				</div>
				<div class="commentBlock">
					<h3>Ricky87</h3>
					<p>Never gonna run around and desert you. Never gonna make you cry.</p>
				</div>
				<div class="commentBlock">
					<h3>AstleyMan</h3>
					<p>Never gonna say goodbye. Never gonna tell a lie and hurt you.</p>
				</div>
		</div>
		
		<footer>
			<p>Authors: Section 321</p>
			<p>A. A. Barczyk - <a href="mailto:ab306198@student.polsl.pl">ab306198@student.polsl.pl</a></p>
			<p>M. R. Paszek -  <a href="mailto:mp306395@student.polsl.pl">mp306395@student.polsl.pl</a></p>
		</footer>
		
	</div>
	
	
		
	
		
</body>
</html>