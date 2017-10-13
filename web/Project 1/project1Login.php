<?php
	require("project1Global.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$statement = $db->prepare("SELECT id FROM project.user WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
		$statement->execute();
		$num_rows = pg_num_rows($statement);
		if($num_rows == 1) {
			$_SESSION['user'] = $_POST['username'];
			header("location: project1Main.php");
		} else {
			$login_error = "Login name or password was not found.";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>David Banking Login</title>
		<link rel="stylesheet" type="text/css" href="#">
	</head>
	<body>
		<h1>David Banking</h1>
		<h3>Welcome! Please Login</h3>
		<p>Login with the username "grader" and password as "password".</p>
		<form action="" method="POST">
			<label for="username">Username:</label>
			<input name="username" type="text"/>
			<label for="password">Password:</label>
			<input name="password" type="password"/>
			<input type="submit" value="Login"/>
		</form>
	</body>
</html>