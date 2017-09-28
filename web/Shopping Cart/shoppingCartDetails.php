<?php
	require("global.php");
	
	if (isset($_POST["quantity"])) {
		if (array_key_exists($_GET["item"], $_SESSION["cart"])) {
			$_SESSION["cart"]["$_GET[item]"] = $_SESSION["cart"]["$_GET[item]"] + $_POST["quantity"];
		} else {
			$_SESSION["cart"]["$_GET[item]"] = $_POST["quantity"];
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart Details</title>
		<link rel="stylesheet" type="text/css" href="shoppingCartStyles.css">
	</head>
	<body>
		<h1>Details For <?php echo $_GET["item"];?></h1>
		<div class="top_button">
			<form action="shoppingCartBrowse.php">
				<input type="submit" value="Browse">
			</form>
		</div>
		<br>
		<div class="panel">
			<h2><?php echo $_GET["item"]; ?></h2>
			<?php echo $items["$_GET[item]"][0]; ?>
			<h3>Description</h3>
			<?php
				echo $items["$_GET[item]"][2];
				echo '<br>';
				echo '<br><div class="inner">-Wikipedia Defintion</div>';
			?>
		</div>
		<br>
		<div class="inner">
			<form action="" method="POST">
				Quantity: <input type="number" name="quantity" value="1" min="1" max="25"><br>
				<div class="inner"><input type="submit" value="Add To Cart"></div>
			</form>
		</div>
		<br>
		<div class="inner">
			<form action="shoppingCart.php">
				<input type="submit" value="Shopping Cart">
			</form>
		</div>
	</body>
</html>