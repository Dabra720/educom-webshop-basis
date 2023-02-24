<?php


function findUserByEmail($email){
  $users_file = fopen("users/users.txt", "a+");
  while(!feof($users_file)){
    $str = explode("|", fgets($users_file));
    if($str[0]==$email){
      return $str;
    }
  }
  fclose($users_file);
  return NULL;
}

function saveUser($email, $name, $password){
  $users_file = fopen("users/users.txt", "a+");
  $user_data = implode("|",array($email, $name, $password));

  fwrite($users_file, "\n" . $user_data);
  fclose($users_file);
}

?>