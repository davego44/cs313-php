<?php
	require("dbConnect.php");
	
	session_start();
	
	if(isset($_SESSION['user'])){
		header("location: home.php");
    }
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$statement = $db->prepare("SELECT id FROM project.user WHERE username=:username AND password=:password");
		$statement->execute(array(':username' => $_POST['username'], ':password' => $_POST['password']));
		$results = $statement->fetch(PDO::FETCH_ASSOC);
		if(isset($results['id'])) {
			$_SESSION['user'] = $results['id'];
			header("location: home.php");
		} else {
			$login_error = "Login username or password was not found.";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>David Banking Login</title>
	</head>
	<body>
		<h1>David Banking</h1>
		<h3>Welcome! Please Login</h3>
		Login to Bob Smith with the username "grader" and the password "password".<br/>
		Login to Robert Smith with the username "graderSon" and the password "password".<br/>
		Login to Emily Smith with the username "graderDaughter" and the password "password".<br/><br/>
		<?php echo '<span style="color:red;">' . $login_error . '</span><br/><br/>'; ?>
		<form action="" method="POST">
			<label for="username">Username:</label>
			<input name="username" type="text"/><br/><br/>
			<label for="password">Password:</label>
			<input name="password" type="password"/><br/><br/>
			<input type="submit" value="Login"/>
		</form>
	</body>
</html>