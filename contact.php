<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Contact</title>
	<link rel="stylesheet" href="CSS/stylesheet.css">
</head>
<body>
<?php
// define variables and set to empty values
$aanhefErr = $nameErr = $emailErr = $phoneErr = $voorkeurErr = $messageErr = "";
$aanhef = $name = $email = $phone = $voorkeur = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$aanhef = $_POST["aanhef"];
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
  	$name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
	}
	if(empty($_POST["email"])){
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
	}
  if(empty($_POST["phone"])){
		$phoneErr = "Telefoonnummer is required";
	} else {
		$phone = test_input($_POST["phone"]);
	}
	if(empty($_POST["voorkeur"])){
		$voorkeurErr = "Communicatievoorkeur is required";
	} else {
		$voorkeur = test_input($_POST["voorkeur"]);
	}
	if(empty($_POST["voorkeur"])){
		$messageErr = "Bericht is required";
	} else {
  	$message = test_input($_POST["message"]);
	}
	if($aanhefErr===""&&$nameErr===""&&$emailErr===""&&$phoneErr===""&&$voorkeurErr===""&&$messageErr===""){
		$msg = "Bedankt " . $aanhef . " " . $name . "." . "\\n";
		$msg .= "Emailadres: " . $email . "\\n";
		$msg .= "Telefoonnummer: " . $phone . "\\n";
		$msg .= "Communicatievoorkeur: " . $voorkeur . "\\n";
		$msg .= "Bericht: " . $message;
		alert($msg);
	}
} else {
	$aanhef = $name = $email = $phone = $voorkeur = $message = "";
}
function alert($msg){
	echo "<script type='text/javascript'>alert('$msg');</script>";
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

	<ul class="navbar">
		<li><a href="index.html">HOME</a></li>
		<li><a href="about.html">ABOUT</a></li>
		<li><a href="contact.php">CONTACT</a></li>
	</ul>
	
	<div class="core">
		<h1>Neem contact met ons op</h1>
		<h2>Contactgegevens</h2>
		<span class="error">* required fields</span>
			<form action="" method="POST">
				Aanhef <select name="aanhef" id="dropdown">
							<option value="dhr">Dhr.</option>
							<option value="mvr">Mvr.</option>
						</select>
				<br><br>
				Naam <input type="text" name="name" value="<?php echo $name; ?>"><span class="error">* <?php echo $nameErr;?></span>
				<br><br>
				E-Mail <input type="text" name="email" value="<?php echo $email; ?>"><span class="error">* <?php echo $emailErr;?></span>
				<br><br>
				Telefoonnummer <input type="text" name="phone" value="<?php echo $phone; ?>"><span class="error">* <?php echo $phoneErr;?></span>
				<br><br>
				Communicatievoorkeur 
				<input type="radio" name="voorkeur" <?php if (isset($voorkeur) && $voorkeur=="Email") echo "checked";?> value="Email">Email
				<input type="radio" name="voorkeur" <?php if (isset($voorkeur) && $voorkeur=="Telefoon") echo "checked";?> value="Telefoon">Telefoon <span class="error">* <?php echo $voorkeurErr;?></span>
				<br><br>
				Bericht <textarea name="message"><?php echo $message;?></textarea><span class="error">* <?php echo $messageErr;?></span>
				<br><br>
				<input type="submit">
			</form>
	</div>
</body>

<footer>
&#169; 2023 Daan Braas
</footer>
</html>
