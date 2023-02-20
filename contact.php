<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Contact</title>
	<link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>

	<ul class="navbar">
		<li><a href="index.html">HOME</a></li>
		<li><a href="about.html">ABOUT</a></li>
		<li><a href="contact.php">CONTACT</a></li>
	</ul>
	
	<div class="core">
		<h1>Neem contact met ons op</h1>
		<h2>Contactgegevens</h2>
		<span class="error">* required fields;</span>
			<form action="" method="POST">
				Aanhef <select name="aanhef" id="dropdown">
							<option value="dhr">Dhr.</option>
							<option value="mvr">Mvr.</option>
						</select><span class="error">* <?php echo $aanhefErr;?></span>
				<br><br>
				Naam <input type="text" name="name"><span class="error">* <?php echo $nameErr;?></span>
				<br><br>
				E-Mail <input type="text" name="email"><span class="error">* <?php echo $emailErr;?></span>
				<br><br>
				Telefoonnummer <input type="text" name="phone"><span class="error">* <?php echo $phoneErr;?></span>
				<br><br>
				Communicatievoorkeur 
				<input type="radio" id="email" name="communicatie" value="Email">Email
				<input type="radio" id="telefoon" name="communicatie" value="Telefoon">Telefoon <span class="error">* <?php echo $communicatieErr;?></span>
				<br><br>
				Bericht <textarea name="message"></textarea><span class="error">* <?php echo $messageErr;?></span>
				<br><br>
				<input type="submit">
			</form>
	</div>

	<?php
// define variables and set to empty values
$aanhefErr = $nameErr = $emailErr = $phoneErr = $communicatieErr = $messageErr = "";
$aanhef = $name = $email = $phone = $communicatie = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$aanhef = $_POST["aanhef"];
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	  } else {
  		$name = test_input($_POST["name"]);
	  }
	  
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $communicatie = test_input($_POST["communicatie"]);
  $message = test_input($_POST["message"]);
} else {

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

</body>
<footer>
©2023 Daan Braas
</footer>
</html>
