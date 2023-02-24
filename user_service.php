<?php
require 'file_repository.php';

function authenticateUser($email, $password){
  $user = findUserByEmail($email);
  if(empty($user)){
    return NULL;
  }

  return $user;
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