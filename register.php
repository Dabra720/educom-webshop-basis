<?php 

function showRegisterContent($data){
  if(!$data['validForm']){
    echo '<h1>Registreer nu je account</h1>
    <h2>Voer je gegevens in:</h2>';
    showRegisterForm($data);
  } else {
    if(!doesUserExist($data['values']['email'])){
      // debug_to_console($data['values']['email']);
      addNewUser($data);
      require('login.php');
      showLoginContent($data);
    } else {
      $data['errors']['email'] = "Already exists";
      echo '<h1>Registreer nu je account</h1>
      <h2>Voer je gegevens in:</h2>';
      showRegisterForm($data);
    }
    
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

function doesUserExist($user){
  $users_file = fopen("users/users.txt", "r");
  while(!feof($users_file)){
    $str = explode("|", fgets($users_file));
    if($str[0]==$user){
      return true;
    }
  }
  fclose($users_file);
  return false;
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