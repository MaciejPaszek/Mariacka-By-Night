<?php
	// Serwerowa baza danych
//	$servername = 	"sql103.infinityfree.com";
//	$username = 	"if0_37859404";
//	$password = 	"Mariacka2Fuego";
//	$dbname = 		"if0_37859404_MariackaByNightDB";
	
	// Lokalna baza danych
	$servername = 	"localhost";
	$username = 	"root";
	$password = 	"";
	$dbname = 		"MariackaByNightDB";
					
	// Połącz z bazą danych
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Sprawdź połączenie z bazą danych
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Ustaw system kodowania znaków na utf-8
    $conn -> set_charset("utf8");
?>