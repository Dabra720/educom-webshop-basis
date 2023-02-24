<?php
function validateLogin(){
  $data = array('validForm'=> false, 'values'=> array(), 'errors'=> array());
  $users = fopen("users/users.txt", "r");

  if($_SERVER['REQUEST_METHOD']=='POST'){
    // if(empty($_POST['password'])){
    //   $data['errors']['email'] = "Email is required";
    // } 
    // if(empty($_POST['email'])){
    //   $data['errors']['password'] = "Password is required";
    // }
    if(userAndPasswordMatch($_POST['email'])){
      echo "Gefeliciteerd, u bent ingelogd";
    } else {
      $data['errors']['email'] = "Email and/or password is wrong";
      $data['errors']['password'] = "Email and/or password is wrong";
    }
    
  }
  fclose($users);
  return $data;
}

function userAndPasswordMatch($user){
  $users = fopen("users/users.txt", "r");
  if(!empty($user)){
    while(!feof($users)){
      $str = explode("|", fgets($users));
      debug_to_console("email: " . $str[0]);
      debug_to_console("password: " . str_replace(array("\r", "\n"), '', $str[2])); // Er kwam een error op breaklines
      // debug_to_console("password: ". $str[0]."+" . $str[1]."+".$str[2]);
      if($str[0]==$_POST['email']){
        debug_to_console("Mail adres gevonden!");
        if($str[2]==$_POST['password']){
          return true;
        }
        break;
      }
    }
  }
  return false;
}

function showLoginContent($data){
  echo '<h1>LOGIN</h1>';
  echo '<h2>Vul je gegevens in</h2>';
  showLoginForm($data);
}

function showLoginForm($data){
  echo '<span class="error">* required fields</span>
	<form action="index.php" method="POST">
		E-Mail: <input type="text" name="email" value=""><span class="error">* '. getArrayVar($data['errors'], 'email') .'</span>
		<br><br>
		Wachtwoord: <input type="text" name="password" value=""><span class="error">* '. getArrayVar($data['errors'], 'password') . '</span>
		<br><br>
		<input type="hidden" name="page" value="login">
		<input type="submit">
	</form>';
}
?>