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
			
			<?php
				// Pobierz informacje o bieżącym barze
				$query = "SELECT * FROM locations WHERE ID = $_GET[id]";
				$result = $conn->query($query);
				
				if ($result->num_rows > 0) {
						
					$row = $result->fetch_assoc();
					
					$barName		= $row["name"];
					$barAdress		= $row["adress"];
					$barOpenHours	= $row["openingHours"];
					$barLink		= $row["link"];
					$barDesc		= $row["description"];
					$barImage		= "img/$row[image]";
					
				} else {
					echo	"<h1> Error 404 </h1>";
					echo		"<p> The bar you are searching for does not exist (yet).</p>";
					echo	"</div>";
					include "footer.php";
					$conn->close();
					die();
				}
				
				// Pobierz informacje o ocenach baru
				$query = "SELECT AVG(rating) as barRating, COUNT(*) as barRatingCount FROM ratings WHERE locationID = $_GET[id]";
				$result = $conn->query($query);
				
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$barRating		= $row["barRating"];
					$barRatingCount		= $row["barRatingCount"];
				}
				
				// Jeśli jest zalogowany użytkownik
				if(isset($_SESSION["userID"]))
				{
					// Pobierz login użytkownika
					$query = "SELECT login FROM users WHERE ID = $_SESSION[userID]";
					$result = $conn->query($query);
						
					$userLogin = "";
						
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						$userLogin = $row["login"];
						
						$userPreviousRate = 0;
						$query = "SELECT rating FROM ratings WHERE locationID = $_GET[id] AND userID = $_SESSION[userID]";
						$result = $conn->query($query);

						if ($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							$userPreviousRate = $row["rating"];
						}
					}
					else {
						echo "User with ID = $_SESSION[userID] does not exist.";	
					}
				}
				
				// Ustaw zmienną sesji locationID na id odczytane z URL
				//$_SESSION["locationID"] = $_GET["id"];
				
				// Pobierz komentarze

				$query = "SELECT c.ID, userID, login, text, date FROM comments c JOIN users u ON c.userID = u.ID WHERE locationID = $_GET[id] ORDER BY date DESC";
				$result = $conn->query($query);
				
				$conn->close();
			?>
			
			<img id="photo" src="<?php echo $barImage; ?>" alt= "<?php echo "There should be a photo of $barName"; ?>" ></img>
		
			<div id="infoSection">
				<h1 id="barName" lang="pl"> <?php echo $barName; ?> </h1>
				<h3 id="barAdress" lang="pl"> <?php echo $barAdress; ?> </h3>
				<h3 id="barOpenHours"> Opening Hours: <?php echo $barOpenHours; ?> </h3>
				<h3 id="barSocial"><a href="<?php echo $barLink; ?>"> Official Site </a></h3>
				<h3 id="barCommunityRating"> Community rating: <?php echo number_format(round($barRating, 1), 1, ".") ?>
				(<?php if($barRatingCount == 1)	echo "1 rating"; else echo "$barRatingCount ratings"; ?>) </h3>
				
				<div class="stars">
					<?php
						$barRating = min($barRating, 5);
					
						$i = 1;
						while($i <= floor($barRating))
						{
							echo	"<svg height='45' width='50'>";
							echo		"<polygon points='25,0 10,45 49,17 1,17, 40,45' style='fill:rgb(255,255,255,100%);'></polygon>";
							echo	"</svg> ";
							$i++;
						}
						
						if($i <= 5)
						{
							$starFill = round(50 * ($barRating - floor($barRating)));

							echo	"<svg height='45' width='50'>";
							echo		"<defs>";
							echo			"<clipPath id='cutFilledStar'>";
							echo				  "<rect x='0' y='0' width='$starFill' height='45' />";
							echo			"</clipPath>";
							echo		"</defs>";
							echo		"<polygon points='25,0 10,45 49,17 1,17, 40,45' style='fill:rgb(255,255,255, 100%);' clip-path='url(#cutFilledStar)' /></polygon>";
							echo		"<polygon points='25,0 10,45 49,17 1,17, 40,45' style='fill:rgb(255,255,255, 20%);'></polygon>";
							echo	"</svg> ";
							$i++;
						}
						
						while($i <= 5)
						{
							echo	"<svg height='45' width='50'>";
							echo		"<polygon points='25,0 10,45 49,17 1,17, 40,45' style='fill:rgb(255,255,255,20%);'></polygon>";
							echo	"</svg> ";
							$i++;
						}
					?>
				</div>
				<h3 id="barYourRating"> Your rating: </h3>
				<div class="stars">
					<?php
					
						if(isset($_SESSION["userID"]))
						{
							$i = 1;
							while($i <= $userPreviousRate)
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
							
							echo	"<script src='ratingStars.js'></script>";
							
							echo	"<br><br>";
							
							echo 	"<form action='insertRating.php' method='post'>";
							echo		"<input type='hidden' name='formUserID' value='$_SESSION[userID]'</input>";
							echo		"<input type='hidden' name='formLocationID' value='$_GET[id]'></input>";
							echo		"<input type='hidden' id='formRating' name='formRating' value='$userPreviousRate'></input>";
							echo		"<button id='ratingSend' type='submit' disabled='true'>Confirm rating</button>";
							echo	"</form>";
							
							echo	"<br>";
							
							echo 	"<form action='deleteRating.php' method='post'>";
							echo		"<input type='hidden' name='formRatingID' value='123'</input>";
							echo		"<button id='ratingSend' type='submit' disabled='true'>Delete rating</button>";
							echo	"</form>";
						}
						else
							echo '<p>You must be logged in to rate.</p>';
					?>
				</div>
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
						if(isset($_SESSION["userID"]))
						{
							echo	"<form action='insertComment.php' method='post'>";
							echo		"<h3> $userLogin </h3>";
							echo		"<input type='hidden' name='formLocationID' value='$_GET[id]'>";
							echo		"<input type='hidden' name='formUserID' value='$_SESSION[userID]'>";
							echo		"<textarea type='text' placeholder='Write comment...' name='formText'></textarea>";
							echo		"<button id='commentSend' type='submit'>Add comment</button>";
							echo	"</form>";
						}
						else
						{
							echo "<p> You must be logged in to post comments. </p>";
						}
					?>
				</div>
				
				<?php
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							
							$commentID			= $row["ID"];
							$commentUserId		= $row["userID"];
							$commentUser		= $row["login"];
							$commentText		= $row["text"];
							$commentDate		= $row["date"];
							$date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $commentDate);
							
							echo	"<div class='commentBlock' id='comment$commentID'>";
							echo		"<h3> $commentUser <span class='commentDate'>(" . $date->format("j M Y H:i") . ")</span> </h3>";
							echo		"<p> $commentText </p>";
							
							if(isset($_SESSION["userID"]))
								if($commentUserId == $_SESSION["userID"])
								{
									echo   "<form action='deleteComment.php' method='post'>";
									echo			"<input type='hidden' name='formCommentID' value='$commentID'>";
									echo			"<input type='hidden' name='formLocationID' value='$_GET[id]'>";
									echo			"<button id='commentDelete' type='submit'>Delete comment</button>";
									echo	"</form>";
								}
											
							echo	"</div>";
						}
					} else {
						echo	"<div class='commentBlock'>";
						echo		"<h3> No comments </h3>";
						echo		"<p> Be the first one to write comment about <b>$barName</b>. </p>";
						echo	"</div>";
					}
				?>
			</div>
		</div>
	
		<?php include "footer.php" ?>
	
	<body>
</html>