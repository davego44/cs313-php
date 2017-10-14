<?php
	require("dbConnect.php");
	require("session.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>David Banking Personal Info</title>
	</head>
	<body>
		<h1>David Banking</h1>
		<h2>Personal Information</h2>
		<p>Changing info is not implemented yet.</p>
		<form action="home.php">
			<input type="submit" value="Back"/>
		</form>
		<br/><br/>
		<?php
			$statement = $db->prepare("SELECT username, first_name, middle_name, last_name, email, phone, address, birthdate, drivers_lic FROM project.user WHERE id=$_SESSION[user]");
			$statement->execute();
			$user = $statement->fetch(PDO::FETCH_ASSOC);
			
			echo "Username: $user[username] <br/>";
			echo "Full Name: $user[first_name] $user[middle_name] $user[last_name] <br/>";
			echo "Email: $user[email] <br/>";
			echo "Phone: $user[phone] <br/>";
			echo "Address: $user[address] <br/>";
			echo "Birthdate: $user[birthdate] <br/>";
			echo "Drivers License: $user[drivers_lic] <br/>";
		?>
	</body>
</html>