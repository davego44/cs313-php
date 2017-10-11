<?php
	$dbUrl = getenv('DATABASE_URL');

	$dbopts = parse_url($dbUrl);

	$dbHost = $dbopts["host"];
	$dbPort = $dbopts["port"];
	$dbUser = $dbopts["user"];
	$dbPassword = $dbopts["pass"];
	$dbName = ltrim($dbopts["path"],'/');

	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
	}
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
			foreach ($db->query("SELECT * FROM teamAct.scriptures") as $row)
			{
			  echo '<span class="boldScrip">' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</span> - "' . $row['content'] . '"';
			  echo '<br/>';
			}
		?>
		<br/>
		<form action="" method="POST">
			<label for="book">Search Book: </label><input type="text" name="book"/>
			<input type="submit" value="Search"/>
		</form>
		<?php
			if(isset($_POST['book'])) {
				foreach ($db->query("SELECT * FROM teamAct.scriptures WHERE book = '$_POST[book]'") as $row)
				{
				  echo '<span class="boldScrip">' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</span> - "' . $row['content'] . '"';
				  echo '<br/>';
				}
			}
		?>
	</body>
</html>