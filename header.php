<p id="title">
		Mariacka By Night
</p>
		
<nav>
	<a href="index.php">
		<div class="navigator">LIST</div>
	</a>
	
	<a href="map.php">
		<div class="navigator">MAP</div>
	</a>
			
	<?php
		if(isset($_SESSION["userID"]))
		{
			echo		"<a href='user.php'>";
			echo			"<div class='navigator'>$_SESSION[userLogin]</div>";
			echo		"</a>";
			
			echo		"<a href='logout.php'>";
			echo			"<div class='navigator'>LOGOUT</div>";
			echo		"</a>";
			}
		else
		{
			echo	"<a href='register.php'>";
			echo			"<div class='navigator'>REGISTER</div>";
			echo		"</a>";

			echo		"<a href='login.php'>";
			echo			"<div class='navigator'>LOGIN</div>";
			echo		"</a>";
		}
	?>
</nav>