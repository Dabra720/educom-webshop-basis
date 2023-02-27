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

    // debug_to_console($data['values']);
    var_dump($data['values']);
    if(!empty($data['values']['email'])){
      if(doesEmailExist($data['values']['email'])){
        $data['errors']['email'] = "Already exists";
      } else{
      if(empty($data['errors'])){
        $data['validForm'] = true;
      }
      }
    }
    
  }
  return $data;
}

// Valideer alle gegevens in het Loginform
function validateLogin(){
  $data = array('validForm'=> false, 'values'=> array(), 'errors'=> array());
  
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $user = authenticateUser($_POST['email'], $_POST['password']);
    if(is_null($user)){
      $data['errors']['email'] = "Email and/or password is wrong";
      $data['errors']['password'] = "Email and/or password is wrong";
    } else{
      $data['validForm'] = true;
      $data['values']['name'] = $user[1];
      doLoginUser($user[1]);
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
?>