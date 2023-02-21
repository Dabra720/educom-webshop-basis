<?php

// define variables and set to empty values
$aanhefErr = $nameErr = $emailErr = $phoneErr = $voorkeurErr = $messageErr = "";
$aanhef = $name = $email = $phone = $voorkeur = $message = "";
$valid = false;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	$aanhef = $_POST["aanhef"];
// 	if (empty($_POST["name"])) {
// 		$nameErr = "Name is required";
// 	} else {
//   	$name = test_input($_POST["name"]);
// 		// check if name only contains letters and whitespace
//     if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
//       $nameErr = "Only letters and white space allowed";
//     }
// 	}
// 	if(empty($_POST["email"])){
// 		$emailErr = "Email is required";
// 	} else {
// 		$email = test_input($_POST["email"]);
// 		// check if e-mail address is well-formed
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       $emailErr = "Invalid email format";
//     }
// 	}
//   if(empty($_POST["phone"])){
// 		$phoneErr = "Telefoonnummer is required";
// 	} else {
// 		$phone = test_input($_POST["phone"]);
// 	}
// 	if(empty($_POST["voorkeur"])){
// 		$voorkeurErr = "Communicatievoorkeur is required";
// 	} else {
// 		$voorkeur = test_input($_POST["voorkeur"]);
// 	}
// 	if(empty($_POST["message"])){
// 		$messageErr = "Bericht is required";
// 	} else {
//   	$message = test_input($_POST["message"]);
// 	}
// 	if($aanhefErr===""&&$nameErr===""&&$emailErr===""&&$phoneErr===""&&$voorkeurErr===""&&$messageErr===""){
// 		$valid = true;
// 	}
// // 	if($aanhefErr===""&&$nameErr===""&&$emailErr===""&&$phoneErr===""&&$voorkeurErr===""&&$messageErr===""){
// // 		$msg = "Bedankt " . $aanhef . " " . $name . "." . "\\n";
// // 		$msg .= "Emailadres: " . $email . "\\n";
// // 		$msg .= "Telefoonnummer: " . $phone . "\\n";
// // 		$msg .= "Communicatievoorkeur: " . $voorkeur . "\\n";
// // 		$msg .= "Bericht: " . $message;
// // 		alert($msg);
// // 	}
// // } else {
// // }
// // function alert($msg){
// // 	echo "<script type='text/javascript'>alert('$msg');</script>";
// }
// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
} 

function showContactContent($data){

	if(!$data['validForm']){
		echo '
			<div class="content">
				<h1>Neem contact met ons op</h1>
				<h2>Contactgegevens</h2>';
				showContactForm($data);
		echo '</div>';
				
	} else {
		echo "Beste " . getArrayVar($data['values'], 'aanhef') . " " . getArrayVar($data['values'], 'name') . ", dankjewel voor het posten!" . "<br>";
		echo "Emailadres: " . $email . "<br>";
		echo "Telefoonnummer: " . $phone . "<br>";
		echo "Communicatievoorkeur: " . $voorkeur . "<br>";
		echo "Bericht: " . $message . "<br>";
	}
}

function showContactForm($data){
	echo '<span class="error">* required fields</span>
	<form action="" method="POST">
		Aanhef: <select name="aanhef" id="dropdown">
			<option value="dhr">Dhr.</option>
			<option value="mvr">Mvr.</option>
		</select>
		<br><br>
		Naam: <input type="text" name="name" value="'.getArrayVar($data['values'], 'name').'"><span class="error">* '.getArrayVar($data['errors'], 'name').'</span>
		<br><br>
		E-Mail: <input type="text" name="email" value="'.getArrayVar($data['values'], 'email').'"><span class="error">* '.getArrayVar($data['errors'], 'email').'</span>
		<br><br>
		Telefoonnummer: <input type="text" name="phone" value="'.getArrayVar($data['values'], 'phone').'"><span class="error">* '.getArrayVar($data['errors'], 'phone').'</span>
		<br><br>
		Communicatievoorkeur: 
		<input type="radio" name="voorkeur" ';?> <?php if (getArrayVar($data['values'], 'voorkeur')=="Email") echo "checked";?> <?php echo ' value="Email">Email
		<input type="radio" name="voorkeur" ';?> <?php if (getArrayVar($data['values'], 'voorkeur')=="Telefoon") echo "checked";?> <?php echo ' value="Telefoon">Telefoon <span class="error">* '.getArrayVar($data['errors'], 'voorkeur').'</span>
		<br><br>
		Bericht: <textarea name="message">'.getArrayVar($data['values'], 'message').'</textarea><span class="error">* '.getArrayVar($data['errors'], 'message').'</span>
		<br><br>
		<input type="hidden" name="page" value="contact">
		<input type="submit">
	</form>';
}
?>
