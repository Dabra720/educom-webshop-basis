<?php 
$page = getRequestedPage();
showResponsePage($page);

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

function showResponsePage($page){
  showDocumentStart();
  showHeadSection($page);
  showBodySection($page);
  showDocumentEnd();
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

function showDocumentStart(){
  echo '<!DOCTYPE html>
        <html>';
}

function showHeadSection($page){
  echo '<head>
	        <meta charset="UTF-8">
	        <title>'. $page .'</title>
          <link rel="stylesheet" href="CSS/stylesheet.css">
        </head>';
}

function showBodySection($page){
  echo '<body>';
  showHeader();
  echo '<div class="content">';
  showContent($page);
  echo '</div>';
  showFooter();
  echo '</body>';
}

function showHeader(){
  echo '
  <header>
		<ul class="navbar">
			<li><a href="index.php?page=home">HOME</a></li>
			<li><a href="index.php?page=about">ABOUT</a></li>
			<li><a href="index.php?page=contact">CONTACT</a></li>';
  echo '<li><a href="index.php?page=register">REGISTER</a></li>';
	echo '</ul>
	</header>';
}

function showContent($page){
  switch($page){
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
      $data = validateContact();
      showContactContent($data);
      break;
    case "register":
      require('register.php');
      $data = validateRegister();
      showRegisterContent($data);
      break;
    case "login":
      require('login.php');
      $data = validateLogin();
      showLoginContent();
      break;
    default:
      pageNotFound();
  }
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

function validateRegister(){
  $data = array('validForm'=> false, 'values'=> array(), 'errors'=> array());

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $data = validateField($data, 'email', 'emailValid');
    $data = validateField($data, 'name', 'nameValid');
    $data = validateField($data, 'password', 'isEmpty');
    $data = validateField($data, 'pass_rep', 'pass_rep');

    if(empty($data['errors'])){
      $data['validForm'] = true;
    }
  }

  return $data;
}

function validateLogin(){
  
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
// Debug tool, om variabelen makkelijk te kunnen checken
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>