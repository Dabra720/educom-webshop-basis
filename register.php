<?php 

function showRegisterContent($data){
  if(!$data['validForm']){
    echo '<h1>Registreer nu je account</h1>
    <h2>Voer je gegevens in:</h2>';
    showRegisterForm($data);
  } else {
    // showResponsePage('login');
    addNewUser($data);
    require('login.php');
    showLoginContent($data);
  }
}

function addNewUser($data){
  $users_file = fopen('users/users.txt', 'a+') or die("Unable to open file!");

  $user_email = getArrayVar($data['values'], 'email');
  $user_name = getArrayVar($data['values'], 'name');
  $user_password = getArrayVar($data['values'], 'password');

  $userArray = array($user_email, $user_name, $user_password);

  fwrite($users_file, "\n" . implode("|", $userArray));
  fclose($users_file);
}

function showRegisterForm($data){
  echo '<span class="error">* required fields</span>
	<form action="index.php" method="POST">
		E-Mail: <input type="text" name="email" value="'.getArrayVar($data['values'], 'email').'"><span class="error">* '.getArrayVar($data['errors'], 'email').'</span>
		<br><br>
		Naam: <input type="text" name="name" value="'.getArrayVar($data['values'], 'name').'"><span class="error">* '.getArrayVar($data['errors'], 'name').'</span>
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