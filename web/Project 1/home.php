<?php
	require("dbConnect.php");
	require("session.php");
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_POST['type'] == "logout") {
			unset($_SESSION['user']);
			header("location: login.php");
		} else if($_POST['type'] == "transfer") {
			$message = "Not Implemented Yet";
			echo "<script type='text/javascript'>alert('$message');</script>";	
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>David Banking</title>
		<link rel="stylesheet" type="text/css" href="home.css">
		
	</head>
	<body>
		<h1>David Banking</h1>
		<div id="transferWindow" class="popUpWindow">
			<div class="transferContent">
				<span class="transferClose" onclick="CloseTransferWindow()">&times;</span>
				<h2>Transfer</h2>
				<p>
					From
					<select>
						<?php
							$statement = $db->prepare("SELECT account_id FROM project.user_account WHERE user_id=$_SESSION[user]");
							$statement->execute();
							while ($account_id = $statement->fetch(PDO::FETCH_ASSOC))
							{
								$statementTWO = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$account_id[account_id]");
								$statementTWO->execute();
								$account = $statementTWO->fetch(PDO::FETCH_ASSOC);
								$statementTWO = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
								$statementTWO->execute();
								$account_type = $statementTWO->fetch(PDO::FETCH_ASSOC);
								
								echo '<option value="' . $account[number] . '">' . $account['number'] . ' : ' . $account_type['name'] . '</option>';
								
							}
							$statement = $db->prepare("SELECT member_id FROM project.user_member WHERE user_id=$_SESSION[user]");
							$statement->execute();
							while ($member_id = $statement->fetch(PDO::FETCH_ASSOC))
							{					
								$statementTWO = $db->prepare("SELECT account_id FROM project.user_account WHERE user_id=$member_id[member_id]");
								$statementTWO->execute();
								while ($account_id = $statementTWO->fetch(PDO::FETCH_ASSOC))
								{
									$statementTHREE = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$account_id[account_id]");
									$statementTHREE->execute();
									$account = $statementTHREE->fetch(PDO::FETCH_ASSOC);
									$statementTHREE = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
									$statementTHREE->execute();
									$account_type = $statementTHREE->fetch(PDO::FETCH_ASSOC);
									
									echo '<option value="' . $account[number] . '">' . $account['number'] . ' : ' . $account_type['name'] . '</option>';
								}
							}
						?>
					</select>
					To
					<select>
						<?php
							$statement = $db->prepare("SELECT account_id FROM project.user_account WHERE user_id=$_SESSION[user]");
							$statement->execute();
							while ($account_id = $statement->fetch(PDO::FETCH_ASSOC))
							{
								$statementTWO = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$account_id[account_id]");
								$statementTWO->execute();
								$account = $statementTWO->fetch(PDO::FETCH_ASSOC);
								$statementTWO = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
								$statementTWO->execute();
								$account_type = $statementTWO->fetch(PDO::FETCH_ASSOC);
								
								echo '<option value="' . $account[number] . '">' . $account['number'] . ' : ' . $account_type['name'] . '</option>';
								
							}
							$statement = $db->prepare("SELECT member_id FROM project.user_member WHERE user_id=$_SESSION[user]");
							$statement->execute();
							while ($member_id = $statement->fetch(PDO::FETCH_ASSOC))
							{					
								$statementTWO = $db->prepare("SELECT account_id FROM project.user_account WHERE user_id=$member_id[member_id]");
								$statementTWO->execute();
								while ($account_id = $statementTWO->fetch(PDO::FETCH_ASSOC))
								{
									$statementTHREE = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$account_id[account_id]");
									$statementTHREE->execute();
									$account = $statementTHREE->fetch(PDO::FETCH_ASSOC);
									$statementTHREE = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
									$statementTHREE->execute();
									$account_type = $statementTHREE->fetch(PDO::FETCH_ASSOC);
									
									echo '<option value="' . $account[number] . '">' . $account['number'] . ' : ' . $account_type['name'] . '</option>';
								}
							}
						?>
					</select>
				</p>
				<p>
					<div style="display:inline;">
						<form action="" method="POST">
							<label for="amount">Amount: $</label>
							<input type="text" name="amount"/><br/><br/>
							<input type="button" onclick="CloseTransferWindow()" value="Cancel"/>
							<input type="hidden" name="type" value="transfer"/>
							<input type="submit" value="Confirm Transfer" style="margin-left:20px;"/>
						</form>
					</div>
				</p>
			</div>
		</div>
		
		<?php 
			$statement = $db->prepare("SELECT first_name FROM project.user WHERE id=$_SESSION[user]");
			$statement->execute();
			$user_name = $statement->fetch(PDO::FETCH_ASSOC);
			echo "Welcome $user_name[first_name]!";
		?>
		<p><form style="display: inline-block;" action="user.php" method="POST">
			<input type="submit" value="View Personal Info"/>
		</form>
		<form style="display: inline-block; margin-left:15px" action="" method="POST">
			<input type="hidden" name="type" value="logout"/>
			<input type="submit" value="Logout"/>
		</form></p>
		<div style="float:left;">
			<h2>Your Accounts</h2>
			<button onclick="ShowTransferWindow()">Make Transfer</button><br/><br/>
			<?php
				$statement = $db->prepare("SELECT account_id FROM project.user_account WHERE user_id=$_SESSION[user]");
				$statement->execute();
				while ($account_id = $statement->fetch(PDO::FETCH_ASSOC))
				{
					$statementTWO = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$account_id[account_id]");
					$statementTWO->execute();
					$account = $statementTWO->fetch(PDO::FETCH_ASSOC);
					$statementTWO = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
					$statementTWO->execute();
					$account_type = $statementTWO->fetch(PDO::FETCH_ASSOC);
					
					echo "$account[number] : $account_type[name] <br/>";
					echo "Balance: $account[amount] <br/>";
					echo '<form action="account.php" method="POST">';
					echo '<input type="hidden" name="account_id" value="' . $account_id['account_id'] . '"/>';
					echo '<input type="submit" value="Details"/>';
					echo '</form>';
					echo "<br/>";
					
				}
			?>
		</div>
		<div style="float:left; margin-left:70px;">
			<h2>Family Member's Accounts</h2>
			<?php
				$statement = $db->prepare("SELECT member_id FROM project.user_member WHERE user_id=$_SESSION[user]");
				$statement->execute();
				while ($member_id = $statement->fetch(PDO::FETCH_ASSOC))
				{
					$statementTWO = $db->prepare("SELECT first_name, last_name FROM project.user WHERE id=$member_id[member_id]");
					$statementTWO->execute();
					$member_name = $statementTWO->fetch(PDO::FETCH_ASSOC);
					
					echo "<h3>$member_name[first_name] $member_name[last_name]'s Accounts</h3>";
					
					$statementTWO = $db->prepare("SELECT account_id FROM project.user_account WHERE user_id=$member_id[member_id]");
					$statementTWO->execute();
					while ($account_id = $statementTWO->fetch(PDO::FETCH_ASSOC))
					{
						$statementTHREE = $db->prepare("SELECT type_id, number, amount FROM project.account WHERE id=$account_id[account_id]");
						$statementTHREE->execute();
						$account = $statementTHREE->fetch(PDO::FETCH_ASSOC);
						$statementTHREE = $db->prepare("SELECT name, info FROM project.account_type WHERE id=$account[type_id]");
						$statementTHREE->execute();
						$account_type = $statementTHREE->fetch(PDO::FETCH_ASSOC);
						
						echo "$account[number] : $account_type[name] <br/>";
						echo "Balance: $account[amount] <br/>";
						echo '<form action="account.php" method="POST">';
						echo '<input type="hidden" name="account_id" value="' . $account_id['account_id'] . '"/>';
						echo '<input type="submit" value="Details"/>';
						echo '</form>';
						echo "<br/>";
					}
				}
			?>
		</div>
		<script type="text/javascript" src="home.js"></script>
	</body>
</html>