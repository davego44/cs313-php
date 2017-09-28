<?php
	require("global.php");
	
	if (isset($_POST["quantity"])) {
		if ($_POST["quantity"] === 0) {
			unset($_SESSION["cart"]["$_POST[item]"]);
		} else {
			$_SESSION["cart"]["$_POST[item]"] = $_POST["quantity"];
		}
	}
	
	if (isset($_POST["delete"])) {
		unset($_SESSION["cart"]["$_POST[item]"]);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
		
		<link rel="stylesheet" type="text/css" href="shoppingCartStyles.css">
	</head>
	<body>
		<h1>Shopping Cart</h1>
		<div class="top_button">
			<form action="shoppingCartBrowse.php">
				<input type="submit" value="Browse">
			</form>
		</div>
		<?php
			if (empty($_SESSION["cart"])) {
				echo "There are no items in your cart.";
			} else {
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
								Item Price: ' . $items["$item"][0] . '
							</div>
							<div class="inner">
								Quantity: ' . $quantity . '
								<div class="inner">
									<form action="" method="POST">
										<input type="hidden" name="item" value="' . $item . '">
										<input type="number" name="quantity" value="' . $quantity .'" min="0" max="25">
										<input type="submit" value="Update">
									</form>
								</div>
							</div>
							<div class="inner">
								Price: ' . ($items["$item"][0] * $quantity) . '
							</div>
							<div class="inner">
								<form action="" method="POST">
									<input type="hidden" name="item" value="' . $item. '">
									<input type="hidden" name="delete" value="true">
									<input type="submit" value="Delete">
								</form>
							</div>
						  </div>';
				}	
				echo 'Total Price: ' . $total;
				echo '<div class="top_button">
						<form action="shoppingCartCheckout.php">
							<input type="submit" value="Checkout">
						</form>
					  </div>';
			}
		?>
		
	</body>
</html>