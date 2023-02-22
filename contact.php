<?php
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
		echo "<div class='content'>";
		echo "Beste " . getArrayVar($data['values'], 'aanhef') . " " . getArrayVar($data['values'], 'name') . ", dankjewel voor het posten!" . "<br>";
		echo "Emailadres: " . getArrayVar($data['values'], 'email') . "<br>";
		echo "Telefoonnummer: " . getArrayVar($data['values'], 'phone') . "<br>";
		echo "Communicatievoorkeur: " . getArrayVar($data['values'], 'voorkeur') . "<br>";
		echo "Bericht: " . getArrayVar($data['values'], 'message') . "<br>";
		echo "</div>";
	}
}

function showContactForm($data){
	echo '<span class="error">* required fields</span>
	<form action="" method="POST">
		Aanhef: <select name="aanhef" id="dropdown">
			<option value="Dhr">Dhr.</option>
			<option value="Mvr">Mvr.</option>
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
