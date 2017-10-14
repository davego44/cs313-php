<?php
	require("dbConnect.php");
	require("session.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>David Banking Account</title>
	</head>
	<body>
		<h1>David Banking</h1>
		<form action="home.php">
			<input type="submit" value="Back"/>
		</form>
		<br/>
		<?php
			$statement = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$_POST[account_id]");
			$statement->execute();
			$account = $statement->fetch(PDO::FETCH_ASSOC);
			$statement = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
			$statement->execute();
			$account_type = $statement->fetch(PDO::FETCH_ASSOC);
			
			echo "$account[number] : $account_type[name] <br/>";
			echo "$account_type[info]<br/>";
			echo "Balance: $account[amount] <br/>";
			
			echo "<h3>Account History</h3>";
			
		?>
		<form action="" method="POST">
			<input type="text" name="search"/>
			<input type="hidden" name="account_id" value="<?php echo $_POST['account_id'];?>"/>
			<input type="submit" value="Search"/>
		</form>
		<br/>
		<?php	
			if(isset($_POST['search']) && !($_POST['search'] == "")) {
				$statement = $db->prepare("SELECT history_entry_id FROM project.history WHERE account_id=$_POST[account_id]"); 
				$statement->execute();
				while ($history_entry_id = $statement->fetch(PDO::FETCH_ASSOC))
				{
					$statementTWO = $db->prepare("SELECT type_id, info, time, amount FROM project.history_entry WHERE id=$history_entry_id[history_entry_id]");
					$statementTWO->execute();
					$history_entry = $statementTWO->fetch(PDO::FETCH_ASSOC);
					$statementTWO = $db->prepare("SELECT name, info FROM project.history_type WHERE id=$history_entry[type_id]");
					$statementTWO->execute();
					$history_type = $statementTWO->fetch(PDO::FETCH_ASSOC);
					if(strpos($history_type['name'], $_POST['search'])    !== false ||
					   strpos($history_type['info'], $_POST['search'])    !== false ||
					   strpos($history_entry['info'], $_POST['search'])   !== false ||
					   strpos($history_entry['time'], $_POST['search'])   !== false ||
					   strpos($history_entry['amount'], $_POST['search']) !== false) {
						echo "Type: $history_type[name] <br/>"; 
						echo "Info: $history_type[info] <br/>";
						echo "Biller: $history_entry[info] <br/>";
						echo "Time: $history_entry[time] <br/>";
						echo "Amount: $history_entry[amount] <br/>";
						echo "<br/>";
					}
				}
			} else {
				$statement = $db->prepare("SELECT history_entry_id FROM project.history WHERE account_id=$_POST[account_id]"); 
				$statement->execute();
				while ($history_entry_id = $statement->fetch(PDO::FETCH_ASSOC))
				{
					$statementTWO = $db->prepare("SELECT type_id, info, time, amount FROM project.history_entry WHERE id=$history_entry_id[history_entry_id]");
					$statementTWO->execute();
					$history_entry = $statementTWO->fetch(PDO::FETCH_ASSOC);
					$statementTWO = $db->prepare("SELECT name, info FROM project.history_type WHERE id=$history_entry[type_id]");
					$statementTWO->execute();
					$history_type = $statementTWO->fetch(PDO::FETCH_ASSOC);
					
					echo "Type: $history_type[name] <br/>"; 
					echo "Info: $history_type[info] <br/>";
					echo "Biller: $history_entry[info] <br/>";
					echo "Time: $history_entry[time] <br/>";
					echo "Amount: $history_entry[amount] <br/>";
					echo "<br/>";
				}
			}
		?>
	</body>
</html>