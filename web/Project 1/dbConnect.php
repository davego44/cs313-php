<?php

	try {
		$dbUrl = getenv('DATABASE_URL');

		/*if (!isset($dbUrl) || empty($dbUrl)) {
			$dbUrl = "postgres://postgres:password@localhost:5432/postgres";
		}*/
		
		$dbopts = parse_url($dbUrl);

		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');

		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);		

		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $ex) {
		echo "Error connecting to database: $ex";
		die();
	}
?>