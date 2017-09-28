<?php
	require("global.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart Confirmation</title>
		<link rel="stylesheet" type="text/css" href="shoppingCartStyles.css">
	</head>
	<body>
		<h1>Order Confirmed</h1>
		<h3>Adress</h3>
		Street: <?php echo $_SESSION["street"];?><br>
		Apt/Suite: <?php echo $_SESSION["apt"];?><br>
		City: <?php echo $_SESSION["city"];?><br>
		State: <?php echo $_SESSION["state"];?><br>
		Zip Code: <?php echo $_SESSION["zip"];?><br>
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
			echo 'Total Price: ' . $total;
			echo '<br>';
			echo 'Thank you for your purchase!';
			$_SESSION["cart"] = array();
		?>
	</body>
</html>