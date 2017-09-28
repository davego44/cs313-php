<?php
	require("global.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Browse</title>
		<link rel="stylesheet" type="text/css" href="shoppingCartStyles.css">
	</head>
	<body>
		<h1>Browse The Goods</h1>
		<div class="top_button">
			<form action="shoppingCart.php">
				<input type="submit" value="Shopping Cart">
			</form>
		</div>
		<br>
		<?php			
			foreach($items as $item => $info) {
				echo '<div class="panel">
						<div class="inner"><h3>' . $item . '</h3></div>
						<div class="inner">' . $info[1] . '</div>
						<div class="inner">' . $info[0] . '</div>
						<div class="inner">
							<form action="shoppingCartDetails.php" method="GET">
								<input type="hidden" name="item" value="' . $item . '">
								<input type="submit" value="View">
							</form>
						</div>
					  </div>';
			}
		?>
		<br>
		
	</body>
</html>