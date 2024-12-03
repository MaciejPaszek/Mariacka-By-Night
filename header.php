<p id="title">
		Mariacka By Night
</p>
		
<nav>
	<a href="list.php">
		<div class="navigator">LIST</div>
	</a>
	
	<a href="map.php">
		<div class="navigator">MAP</div>
	</a>
			
	<?php
		if(isset($_SESSION["userID"]))
		{
			echo	'<div class="navigator">'.$_SESSION["userLogin"].'  </div>
					
					<a href="logout.php">
						<div class="navigator">LOGOUT</div>
					</a>';
			}
		else
		{
			echo	'<a href="register.php">
						<div class="navigator">REGISTER</div>
					</a>
			
					<a href="login.php">
						<div class="navigator">LOGIN</div>
					</a>';
		}
	?>

</nav>