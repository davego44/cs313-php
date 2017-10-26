<?php
	require('dbConnect.php');
	require('password.php');
	
	session_start();
	
	/*if (isset($_SESSION['username'])) {
		echo "<script>window.alert('You are signed in already.');</script>";
		header("location: week7TeamWelcome.php");
	}*/

	$username = $loginError = "";
	
	$usernameError = $passwordError = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST['username'])) {
			$username = test_input($_POST['username']);
		} else {
			$usernameError = "You must enter your username";
		}
		if (!empty($_POST['password'])) {
			$password = test_input($_POST['password']);
		} else {
			$passwordError = "You must enter your password";
		}
		if (!empty($_POST['username']) && !empty($_POST['username'])) {
			$st = $db->prepare("SELECT * FROM week7.user WHERE username = '$username'");
			$st->execute();
			$row = $st->fetch();
			$passFromDB = $row['password'];
			echo $passFromDB;
			echo "<br/>";
			echo $row['username'];
			echo "<br/>";
			echo $password;
			if (password_verify($password, $passFromDB)) {
				$_SESSION['username'] = $username;
				header("location: week7TeamWelcome.php");
				die();
			} else {
				$loginError = "Invalid username or password";
			}
		}
	}
	
	function test_input($data) {
	  //$data = trim($data);
	  //$data = stripslashes($data);
	  //$data = htmlspecialchars($data);
	  return $data;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Week 7 Team Sign In</title>
	</head>
	<body>
		<form action="" method="POST">
			<label for="username">Username</label>
			<input type="text" maxlength="100" name="username" value="<?php echo $username;?>"/><span style="color:red;"><?php echo $usernameError;?></span>
			<label for="password">Password</label>
			<input type="password" maxlength="100" name="password"/><span style="color:red;"><?php echo $passwordError;?></span>
			<input type="submit" value="Login"/><span style="color:red;"><?php echo $loginError;?></span>
		</form>
		
		<a href="week7TeamSignUp.php">Don't have an account? Sign up!</a>
	</body>
</html>