<?php

	$host = 'localhost';
	$port = 3308;
	$driver = $host.':'.$port;
	$username = 'root';
	$password = '';
	$dbname = 'programming_blog';
	
	try {
		$conn = mysqli_connect($driver, $username, $password, $dbname);
	}
	
	catch(Exception $e) {
			echo "Connection Error";
	}