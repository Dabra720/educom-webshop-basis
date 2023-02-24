<?php
// Valideer alle gegevens in het Contactform
function validateContact(){
  $data = array('validForm'=> false, 'values'=> array(), 'errors'=> array());

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = validateField($data, 'aanhef', 'isEmpty');
    $data = validateField($data, 'name', 'nameValid');
    $data = validateField($data, 'email', 'emailValid');
    $data = validateField($data, 'phone', 'isEmpty');
    $data = validateField($data, 'voorkeur', 'isEmpty');
    $data = validateField($data, 'message', 'isEmpty');

    if(empty($data['errors'])){
      $data['validForm'] = true;
    }
  }

  return $data;
}

// Valideer alle gegevens in het Registerform
function validateRegister(){
  $data = array('validForm'=> false, 'values'=> array(), 'errors'=> array());

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = validateField($data, 'email', 'emailValid');
    $data = validateField($data, 'name', 'nameValid');
    $data = validateField($data, 'password', 'isEmpty');
    $data = validateField($data, 'pass_rep', 'pass_rep');

    if(doesEmailExist($data['values']['email'])){
      $data['errors']['email'] = "Already exists";
    } else{
      if(empty($data['errors'])){
        $data['validForm'] = true;
      }
    }
    
  }
  return $data;
}

// Valideer alle gegevens in het Loginform
function validateLogin(){
  $data = array('validForm'=> false, 'values'=> array(), 'errors'=> array());

  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(userAndPasswordMatch($_POST['email'])){
      $_SESSION['username'] = $_POST['email'];
      echo "Gefeliciteerd, u bent ingelogd";
    } else {
      $data['errors']['email'] = "Email and/or password is wrong";
      $data['errors']['password'] = "Email and/or password is wrong";
    }
  }
  return $data;
}

function validateField($array, $value, $check){
  switch($check){
    case 'isEmpty':
      if(empty($_POST[$value])){
        $array['errors'][$value] = $value . " is required";
      } else {
        $array['values'][$value] = test_input($_POST[$value]);
      }
      break;
    case 'nameValid':
      if (empty($_POST[$value])) {
        $array['errors'][$value] = $value. " is required";
      } else {
        $array['values'][$value] = test_input($_POST[$value]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$array['values'][$value])) {
          $array['errors'][$value] = "Only letters and white space allowed";
        }
      }
      break;
    case 'emailValid':
      if(empty($_POST[$value])){
        $array['errors'][$value] = "Email is required";
      } else {
        $array['values'][$value] = test_input($_POST[$value]);
        // check if e-mail address is well-formed
        if (!filter_var($array['values'][$value], FILTER_VALIDATE_EMAIL)) {
          $array['errors'][$value] = "Invalid ". $value ." format";
        }
      }
      break;
    case 'pass_rep':
      if(empty($_POST[$value])){
        $array['errors'][$value] = "Repeat the password";
      } else {
        if(!strcmp($_POST[$value], $array['values']['password'])){
          $array['values'][$value] = $_POST[$value];
        } else{
          $array['errors'][$value] = "Passwords don't match";
          $array['errors']['password'] = "Passwords don't match";
          $array['values'][$value] = "";
          $array['values']['password'] = "";
        }
      }
      break;
  }
  return $array;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
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
        if(str_replace(array("\r", "\n"), '', $str[2])==$_POST['password']){
          return true;
        }
        break;
      }
    }
  }
  return false;
}


?>