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
	
	$book = $chapter = $verse = $content = "";
	$topic = array();
	$bookError = $chapterError = $verseError = $contentError = $topicError = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["book"])) {
			$bookError = "Book is required";
		} else {
			$book = test_input($_POST["book"]);
		}
		if (empty($_POST["chapter"])) {
			$chapterError = "Chapter is required";
		} else {
			$chapter = test_input($_POST["chapter"]);
		}
		if (empty($_POST["verse"])) {
			$verseError = "Verse is required";
		} else {
			$verse = test_input($_POST["verse"]);
		}
		if (empty($_POST["content"])) {
			$contentError = "Content is required";
		} else {
			$content = test_input($_POST["content"]);
		}
		if (empty($_POST["topic"])) {
			$topicError = "Topic is required";
		}
		if (!empty($_POST["book"]) && !empty($_POST["chapter"]) && 
			!empty($_POST["verse"])  && !empty($_POST["topic"]) &&
			!empty($_POST["content"])) {
				$st = $db->prepare("INSERT INTO teamact.scriptures (book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)");
				$st->execute(array(':book' => $book, ':chapter' => $chapter, ':verse' => $verse, ':content' => $content));
				$id = $db->lastInsertId();
				foreach ($_POST['topic'] as $key => $value) {
					var_dump($value);
					//$st = $db->prepare("INSERT INTO teamact.scripture_topics (topic_id, scripture_id) VALUES ((SELECT id FROM teamact.topics WHERE name = $value), $id)");
					//$st->execute();
				}
				//header("Location: week6_2.php");
		}
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Scripture Resources</title>
	</head>
	<body>
		<h1>Scripture Resources</h1>
		<form action="" method="POST">
			<label for="book">Book</label>
			<input type="text" name="book" value="<?php echo $book;?>">
			<span style="color:red;">* <?php echo $bookError; ?></span><br/>
			<label for="chapter">Chapter</label>
			<input type="text" pattern="[0-9]+" title="Must be a number" name="chapter" value="<?php echo $chapter;?>">
			<span style="color:red;">* <?php echo $chapterError; ?></span><br/>
			<label for="verse">Verse</label>
			<input type="text" pattern="[0-9]+\-?[0-9]+" title="Format 1-2 or 1" name="verse" value="<?php echo $verse;?>">
			<span style="color:red;">* <?php echo $verseError; ?></span><br/>
			<label for="content">Content</label>
			<textarea name="content" rows="5" cols="10"><?php echo $content;?></textarea><br/>
			<span style="color:red;">* <?php echo $contentError;?></span><br/>
			<label for="topic[]">Topic</label><br/>
			<?php
				$st = $db->prepare("SELECT name FROM teamact.topics");
				$st->execute();
				while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
					echo '<input type="checkbox" name="topic[]" value="' . $row['name'] . '">' . $row['name'] . '<br/>';
				}
			?>		
			<span style="color:red;">* <?php echo $topicError; ?></span><br/>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>