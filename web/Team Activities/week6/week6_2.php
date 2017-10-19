<?php
	$dbUrl = getenv('DATABASE_URL');

	$dbopts = parse_url($dbUrl);

	$dbHost = $dbopts["host"];
	$dbPort = $dbopts["port"];
	$dbUser = $dbopts["user"];
	$dbPassword = $dbopts["pass"];
	$dbName = ltrim($dbopts["path"],'/');

	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Scripture Resources</title>
	</head>
	<body>
		<h1>Scripture Resources Page 2</h1>
		<?php
			$st = $db->prepare("SELECT * FROM teamact.scriptures");
			$st->execute();
			while($scripture = $st->fetch(PDO::FETCH_ASSOC)) {
				echo "$scripture[book] $scripture[chapter] $scripture[verse] $scripture[content]";
				echo "<br/>";
				$stTwo = $db->prepare("SELECT t.name FROM teamact.scripture_topics AS st INNER JOIN teamact.topics AS t ON t.id = st.topic_id WHERE st.scripture_id = :scripture_id");
				$stTwo->bindValue(':scripture_id', $scripture['id']);
				$stTwo->execute();
				while($topic = $stTwo->fetch(PDO::FETCH_ASSOC)) {
					echo "$topic[name]<br/>";
				}
				echo "<br/>";
			}
		?>
	</body>
</html>