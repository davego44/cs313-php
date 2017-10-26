<?php
    session_start();
	
	if (!isset($_SESSION['username'])) {
		header("location: week7TeamSignIn.php");
		die();
	}
	
	$username = $_SESSION['username'];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <h1>This is the Welcome Page</h1>
        <?php 
            if($username!=NULL){
                echo "<p> Welcome " . $username . "!";
            }
        ?>
    </body>
</html>