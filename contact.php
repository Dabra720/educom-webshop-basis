<?php

function showContactContent($data){
	echo '<h1>Neem contact met ons op</h1>
	<h2>Contactgegevens</h2>';
	showContactForm($data);
}

function showContactThanks($data){
	echo "Beste " . getArrayVar($data['values'], 'aanhef') . " " . getArrayVar($data['values'], 'name') . ", dankjewel voor het posten!" . "<br>";
	echo "Emailadres: " . getArrayVar($data['values'], 'email') . "<br>";
	echo "Telefoonnummer: " . getArrayVar($data['values'], 'phone') . "<br>";
	echo "Communicatievoorkeur: " . getArrayVar($data['values'], 'voorkeur') . "<br>";
	echo "Bericht: " . getArrayVar($data['values'], 'message') . "<br>";
}

function showContactForm($data){
	echo '<span class="error">* required fields</span>
	<form action="index.php" method="POST">
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
		<input type="radio" name="voorkeur" '; if (getArrayVar($data['values'], 'voorkeur')=="Email") echo "checked"; echo ' value="Email">Email
		<input type="radio" name="voorkeur" '; if (getArrayVar($data['values'], 'voorkeur')=="Telefoon") echo "checked"; echo ' value="Telefoon">Telefoon <span class="error">* '.getArrayVar($data['errors'], 'voorkeur').'</span>
		<br><br>
		Bericht: <textarea name="message">'.getArrayVar($data['values'], 'message').'</textarea><span class="error">* '.getArrayVar($data['errors'], 'message').'</span>
		<br><br>
		<input type="hidden" name="page" value="contact">
		<input type="submit">
	</form>';
}
?>
