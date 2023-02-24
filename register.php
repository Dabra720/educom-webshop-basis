<?php 
function showRegisterContent($data){
  echo '<h1>Registreer nu je account</h1>
  <h2>Voer je gegevens in:</h2>';
  showRegisterForm($data);
}

function showRegisterForm($data){
  echo '<span class="error">* required fields</span>
	<form action="index.php" method="POST">
    Naam: <input type="text" name="name" value="'.getArrayVar($data['values'], 'name').'"><span class="error">* '.getArrayVar($data['errors'], 'name').'</span>
		<br><br>
		E-Mail: <input type="text" name="email" value="'.getArrayVar($data['values'], 'email').'"><span class="error">* '.getArrayVar($data['errors'], 'email').'</span>
		<br><br>
		Wachtwoord: <input type="text" name="password" value="'. getArrayVar($data['values'], 'password') . '"><span class="error">* '. getArrayVar($data['errors'], 'password') . '</span>
		<br><br>
		Herhaal wachtwoord: <input type="text" name="pass_rep" value="'. getArrayVar($data['values'], 'pass_rep') . '"><span class="error">* '. getArrayVar($data['errors'], 'pass_rep') . '</span>
		<br><br>
		<input type="hidden" name="page" value="register">
		<input type="submit">
	</form>';
}


?>