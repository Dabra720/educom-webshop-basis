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
//============================================== 
function getPostVar($key, $default='') 
{ 
    return getArrayVal($_POST, $key, $default);

    /* Or use the modern variant below, a better way than accessing super global "$_POST"
  
       see https://www.php.net/manual/en/function.filter-input.php 
       for extra options 

       $value = filter_input(INPUT_POST, $key); 
        
       return isset($value) ? $value : $default; 
    */
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
  showContent($page);
  showFooter();
  echo '</body>';
}

function showHeader(){
  echo '
  <header>
		<ul class="navbar">
			<li><a href="index.php?page=home">HOME</a></li>
			<li><a href="index.php?page=about">ABOUT</a></li>
			<li><a href="index.php?page=contact">CONTACT</a></li>
		</ul>
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
      showContactContent();
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
?>