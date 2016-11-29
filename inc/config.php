<?php

   	$db_user = 'root';
	$db_pass = '';
	$db_n = 'restaurant';
	$db_hoster = 'localhost';
	$item_per_page = 6;
	
	$mysqli = new mysqli($db_hoster, $db_user, $db_pass, $db_n);
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}


?>
