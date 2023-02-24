<?php 

function doLoginUser($name){
  $_SESSION['username'] = $name;
}
function isUserLoggedIn(){
  if(isset($_SESSION['username'])){
    return TRUE;
  } else { return FALSE; }
}
function getLoggedInUserName(){
  return $_SESSION['username'];
}
function doLogoutUser(){
  session_unset();
}


?>