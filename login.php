<?php
function showLoginContent(){
  echo '<h1>LOGIN</h1>';
  echo '<h2>Vul je gegevens in</h2>';
  showLoginForm();
}

function showLoginForm(){
  echo '<span class="error">* required fields</span>
	<form action="index.php" method="POST">
		E-Mail: <input type="text" name="email" value=""><span class="error">* '.getArrayVar($data['errors'], 'email').'</span>
		<br><br>
		Wachtwoord: <input type="text" name="password" value=""><span class="error">* '. getArrayVar($data['errors'], 'password') . '</span>
		<br><br>
		<input type="hidden" name="page" value="login">
		<input type="submit">
	</form>';
}
?>