<?php 
session_start();

require 'validation.php';
require 'user_service.php';
require 'session_manager.php';


$page = getRequestedPage();
$data = processRequest($page);
var_dump($data);
showResponsePage($data);

function getRequestedPage() 
{     
   $requested_type = $_SERVER['REQUEST_METHOD']; 
   if ($requested_type == 'POST') 
   { 
       $requested_page = getPostVar('page','home'); 
   } 
   else 
   { 
       $requested_page = getUrlVar('page','home'); 
   } 
   return $requested_page; 
} 

function processRequest($page){
  switch ($page){
    case 'login':
      $data = validateLogin();
      if($data['validForm']){
        doLoginUser($data['name']);
        $page = 'home';
      }
      break;
    case 'logout':
      doLogoutUser();
      $page = 'home';
      break;
    case 'contact';
      $data = validateContact();
      if($data['validForm']){
        $page = 'thanks';
      }
      break;
    case 'register':
      $data = validateRegister();
      // debug_to_console($data['email']. $data['name']. $data['password']);
      if($data['validForm']){
        storeUser($data['values']['email'], $data['values']['name'], $data['values']['password']);
        $page = 'login';
      }
      break;
    default:
      break;

  }
  $data['page'] = $page;
  return $data;
}

function showResponsePage($data){
  showDocumentStart();
  showHeadSection($data);
  showBodySection($data);
  showDocumentEnd();
}

function showDocumentStart(){
  echo '<!DOCTYPE html>
        <html>';
}

function showHeadSection($data){
  echo '<head>
	        <meta charset="UTF-8">
	        <title>'. $data['page'] .'</title>
          <link rel="stylesheet" href="CSS/stylesheet.css">
        </head>';
}

function showBodySection($data){
  echo '<body>';
  showHeader($data);
  echo '<div class="content">';
  showContent($data);
  echo '</div>';
  showFooter();
  echo '</body>';
}

function showHeader($data){
  echo '
  <header>
		<ul class="navbar">
			<li><a href="index.php?page=home">HOME</a></li>
			<li><a href="index.php?page=about">ABOUT</a></li>
			<li><a href="index.php?page=contact">CONTACT</a></li>';
  if(!isUserLoggedIn()){
    echo '<li><a href="index.php?page=register">REGISTER</a></li>';
    echo '<li><a href="index.php?page=login">LOGIN</a></li>';
  } else {
    echo '<li><a href="index.php?page=logout">LOGOUT ' . $_SESSION['username'] . '</a></li>';
  }
  
	echo '</ul>
	</header>';
}

function showContent($data){
  switch($data['page']){
    case "home":
      require('home.php');
      showHomeContent();
      break;
    case "about":
      require('about.php');
      showAboutContent();
      break;
    case "contact":
      require('contact.php');
      showContactContent($data);
      break;
    case "register":
      require('register.php');
      showRegisterContent($data);
      break;
    case "login":
      require('login.php');
      showLoginContent($data);
      break;
    case "thanks":
      require 'contact.php';
      showContactThanks($data);
    default:
      pageNotFound();
  }
}

function logOut()
{
    session_unset();
}

function showFooter(){
  echo '<footer>
  &#169; 2023 Daan Braas
  </footer>';
}

function showDocumentEnd(){
  echo "</html>";
}

function pageNotFound(){
  echo '<div class="content">
  <h1>PAGE NOT FOUND 404</h1>
  </div>';
}

function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
}

function getPostVar($key, $default='')
{ 
  $value = filter_input(INPUT_POST, $key); 
  return isset($value) ? $value : $default;
} 

function getUrlVar($key, $default=''){
  return isset($_GET[$key]) ? $_GET[$key] : $default;
}

// Debug tool, om variabelen makkelijk te kunnen checken
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "');</script>";
}

?>