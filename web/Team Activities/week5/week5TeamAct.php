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
		</style>
	</head>
	<body>
		<h1>Scripture Resources</h1>
		<?php
			foreach ($db->query("SELECT * FROM teamAct.scriptures") as $row)
			{
			  echo 'chapter: ' . $row['chapter'];
			  echo '<br/>';
			}
		?>
	</body>
</html>