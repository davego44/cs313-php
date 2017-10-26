<?php
	require('dbConnect.php');
	require('password.php');
	
	session_start();
	
	if (isset($_SESSION['username'])) {
		echo "<script>window.alert('You are signed in already.');</script>";
		header("location: week7TeamWelcome.php");
	}
	
	$username = "";
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
			echo "HERE";
			$st = $db->prepare("SELECT username FROM week7.user WHERE username = '$username'");
			$st->execute();
			$count = (int)$st->rowCount();
			if ($count == 0) {
				echo "count is 0";
				$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$st = $db->prepare("INSERT INTO week7.user (username, password) VALUES('$username', '$hashedPassword')");
				$st->execute();
				$_SESSION['username'] = $username;
				header("location: week7TeamWelcome.php");
				die();
			} else {
				echo "count is not 0";
				$usernameError = "Your username already exists.";
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
        <title>Sign up page</title>
    </head>

    <body>
        <h2>Sign up for our website!!</h2>
        <form action="" method="POST">
            
            <label for="username">Enter a unique username</label><span style="color:red;"><?php echo $usernameError;?></span>
            <input type="text" name="username" value="<?php echo $username;?>">

            <label for="password">Enter a password</label><span style="color:red;"><?php echo $passwordError;?></span>
            <input type="password" name="password">

            <input type="submit">
        </form>

        <a href="week7TeamSignIn.php">sign in</a>
    </body>
</html>