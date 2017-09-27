<!Doctype HTML>
<html>
<body>
<?php
	$name = "";
	$email = "";
	$major = "";
	$places = "";
	$comments = "";

	//if ($_SERVER["REQUEST_METHOD"] == "POST") {
		/*$name = test_input($_POST["name"]);
		$email = test_input($_POST["email"]);
		$major = test_input($_POST["major"]);
		$places = test_input($_POST["places"]);
		$comments = test_input($_POST["comments"]);*/
	//}

	/*function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}*/

	function display() {
		echo "Name: " . $_POST["name"];
		echo "Email: " . $_POST["email"];
		echo "Major: " . $_POST["major"];
		echo "Places Visited: ";
		displayPlaces();
		echo "Comments: " . $_POST["comments"];
	}
	
	function displayPlaces() {
		if(isset($_POST['invite'])){
			if (is_array($_POST['invite'])) {
				foreach($_POST["places"] as $value){
					echo $value;
				}
			} else {
				$value = $_POST['invite'];
				echo $value;
			}
		}
	}
	
	display();
?>
</body>
</html>