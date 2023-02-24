<?php
require 'file_repository.php';

function authenticateUser($email, $password){
  $user = findUserByEmail($email);
  if(!empty($user)){
    if(str_replace(array("\r", "\n"), '', $user[2])==$password){
      return $user;
    }
  } else{
    return NULL;
  }
}

function doesEmailExist($email){
  if(!is_null(findUserByEmail($email))){
    return true;
  } else {return false;}
}

function storeUser($email, $name, $password){
  saveUser($email, $name, $password);
}

?>