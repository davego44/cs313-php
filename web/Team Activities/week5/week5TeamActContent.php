<?php
	$dbUrl = getenv('DATABASE_URL');

	$dbopts = parse_url($dbUrl);

	$dbHost = $dbopts["host"];
	$dbPort = $dbopts["port"];
	$dbUser = $dbopts["user"];
	$dbPassword = $dbopts["pass"];
	$dbName = ltrim($dbopts["path"],'/');

	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Scripture Resources</title>
		<style>
			.boldScrip {
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<h1>Scripture Resources</h1>
		<?php
			$statement = $db->query("SELECT * FROM teamAct.scriptures WHERE id = '$_GET[id]'");
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			echo '<span class="boldScrip">' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</span> - "' . $row['content'] . '"<br/>';
		?>
	</body>
</html>