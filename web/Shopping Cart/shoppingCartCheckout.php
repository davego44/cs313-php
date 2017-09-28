<?php
	require("global.php");
	
	$streetError = $cityError = $stateError = $zipError = "";
	$street = $apt = $city = $state = $zip = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["street"])) {
			$streetError = "Street is required";
		} else {
			$street = test_input($_POST["street"]);
		}
		if (empty($_POST["city"])) {
			$cityError = "City is required";
		} else {
			$city = test_input($_POST["city"]);
		}
		if (empty($_POST["state"])) {
			$stateError = "State is required";
		} else {
			$state = test_input($_POST["state"]);
		}
		if (empty($_POST["zip"])) {
			$zipError = "Zip Code is required";
		} else {
			$zip = test_input($_POST["zip"]);
		}
		if (!empty($_POST["apt"])) {
			$apt = test_input($_POST["apt"]);
		}
		if (!empty($_POST["street"]) && !empty($_POST["city"]) && 
			!empty($_POST["state"])  && !empty($_POST["zip"])) {
				$_SESSION["street"] = $street;
				$_SESSION["apt"] = $apt;
				$_SESSION["city"] = $city;
				$_SESSION["state"] = $state;
				$_SESSION["zip"] = $zip;
				header("Location: shoppingCartConfirmation.php");
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
		<title>Shopping Cart Checkout</title>
		<link rel="stylesheet" type="text/css" href="shoppingCartStyles.css">
	</head>
	<body>
		<h1>Shopping Cart Checkout</h1>
		<form action="shoppingCart.php">
			<input type="submit" value="Shopping Cart">
		</form>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h3>Address</h3>
			<span class="error">* required field</span><br><br>
			<div class="address">
				<label for="street">Street: </label>
				<input type="text" name="street" maxlength="40" value="<?php echo $street;?>"><span class="error">* <?php echo $streetError;?></span><br>
			</div>
			<div class="address">
				<label for="apt">Apt/Suite: </label>
				<input type="text" name="apt" size="8" maxlength="20" value="<?php echo $apt;?>"><br>
			</div>
			<div class="address">
				<label for="city">City: </label>
				<input type="text" name="city" size="8" maxlength="20" value="<?php echo $city;?>"><span class="error">* <?php echo $cityError;?></span><br>
			</div>
			<div class="address">
				<label for="state">State: </label>
				<input type="text" name="state" pattern="[A-Z]{2}" title="Capitalized State (ex: CA, MN, ...)" maxlength="2" size="1" value="<?php echo $state;?>"><span class="error">* <?php echo $stateError;?></span><br>
			</div>
			<div class="address">
				<label for="zip">Zip Code: </label>
				<input type="text" name="zip" pattern="[0-9]{5}" title="Five Digit Zip Code" size="3" maxlength="5" value="<?php echo $zip;?>"><span class="error">* <?php echo $zipError;?></span><br>
			</div>
			<h3>Order</h3>
			<?php
				$total = 0.0;
				foreach($_SESSION["cart"] as $item => $quantity) {
					$total += $items["$item"][0] * $quantity;
					echo '<div class="panel">
							<div class="inner">
								Name: ' . $item . '
							</div>
							<div class="inner">
								Description: ' . $items["$item"][1] . '
							</div>
							<div class="inner">
								Quantity: ' . $quantity . '
							</div>
							<div class="inner">
								Price: ' . ($items["$item"][0] * $quantity) . '
							</div>
						  </div>';
				}	
				echo '<br>';
				echo '<div class="inner">Total Price: ' . $total . '</div>';
			?>
			
			<div class="inner"><input type="submit" value="Confirm Purchase"></div>
		</form>
	</body>
</html>