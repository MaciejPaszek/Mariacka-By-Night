<?php
	session_start();

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

	$query = "SELECT * FROM MariackaByNightDB.locations WHERE ID = " . $_GET["id"];
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
			
		$row = $result->fetch_assoc();
		$barName		= $row["name"];
		$barAdress		= $row["adress"];
		$barOpenHours	= $row["openingHours"];
		$barLink		= $row["link"];
		$barDesc		= $row["description"];
		$barImage		= 'img/' . $row["image"];
	} else {
		  echo "0 results";
	}
	
	
	if(isset($_SESSION["userID"]))
	{
		$query = "SELECT login FROM MariackaByNightDB.users WHERE ID = " . $_SESSION["userID"];
		$result = $conn->query($query);
			
		$userLogin = "";
			
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$userLogin = $row["login"];
		}
		else {
			echo "User with ID = " . $_SESSION["userID"] . " does not exist.";	
		}
	}
	
	$_SESSION["locationID"] = $_GET["id"];
		
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
		
			<img id="photo" src="<?php echo $barImage; ?>" alt= "<?php echo "There should be a photo of " . $barName; ?>" ></img>
		
			<div id="infoSection">
				<h1 id="barName"> <?php echo $barName; ?> </h1>
				<h3 id="barAdress"> <?php echo $barAdress; ?> </h3>
				<h3 id="barOpenHours"> <?php echo $barOpenHours; ?> </h3>
				<h3 id="barRating">&#9733 &#9733 &#9733 &#9733 &#9734 4.3 (32 ratings)</h3>
				<h3 id="barSocial"><a href="<?php echo $barLink; ?>"> <?php echo $barLink; ?> </a></h3>
			</div>
			
			<div id="descriptionSection">
				<h2>Description</h2>
				<p>
					<?php echo $barDesc; ?>	
				</p>
			</div>
			
			<div id="commentSection">
			
				<h2>Comments</h2>
				
				<div class="commentBlock">
				
					<?php
						if(isset($userLogin))
						{
							echo '<form action="insertComment.php" method="post">
										<h3> ' . $userLogin . ' </h3>
										<textarea type="text" placeholder="Write comment..." name="formText"></textarea>
										<button id="commentSend" type="submit">Add comment</button>
									</form>';
						}
						else
						{
							echo '<h3> You must be logged in to post comments. </h3>';
						}
					?>
				
					
				</div>
				
				<?php
					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					  die("Connection failed: " . $conn->connect_error);
					}

					$query = "SELECT login, text, date FROM MariackaByNightDB.comments c JOIN MariackaByNightDB.users u ON c.userID = u.ID WHERE locationID = " . $_GET["id"];
					$result = $conn->query($query);

					if ($result->num_rows > 0) {
							
						$row = $result->fetch_assoc();
						$commentUser		= $row["login"];
						$commentText		= $row["text"];
						$commentDate		= $row["date"];
						
						
						$date = DateTimeImmutable::createFromFormat('Y-m-d', $commentDate);
						
						echo	'<div class="commentBlock">
									<h3>' . $commentUser . ' <span class="commentDate">(' . $date->format('j M Y') . ')</span> </h3>
									<p>'  . $commentText .  '</p>
								</div>';
						
					} else {
						echo	'<div class="commentBlock">
									<h3> Brak komentarzy </h3>
								</div>';
						 echo "Brak komentarzy";
					}
					
						
					$conn->close();
				?>
		</div>
	</div>
	
	<?php include "footer.php" ?>
	
</body>
</html>