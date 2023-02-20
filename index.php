<?php 
$page = getRequestedPage();
showResponsePage($page);

if($_SERVER["REQUEST_METHOD"]=="GET"){
}

function getRequestedPage(){
  $page = $_GET["page"];
  return $page;
}

function showResponsePage(){
  showDocumentStart();
  showHeadSection();
  showBodySection();
  showDocumentEnd();
}

function showDocumentStart(){
  echo '<!DOCTYPE html>
        <html>';
}

function showHeadSection(){
  echo '<head>
	        <meta charset="UTF-8">
	        <title>'. getRequestedPage() .'</title>
          <link rel="stylesheet" href="CSS/stylesheet.css">
        </head>';
}

function showBodySection(){
  echo '<body>';
  showHeader();
  include(showBodyContent(getRequestedPage()));
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

function showBodyContent($page){
  $toLoad = "";
  switch($page){
    case "home":
      $toLoad = "home.php";
      break;
    case "about":
      $toLoad = "about.php";
      break;
    case "contact": 
      $toLoad = "contact.php";
  }
  return $toLoad;
}

function showFooter(){
  echo '<footer>
          &#169; 2023 Daan Braas
        </footer>';
}

function showDocumentEnd(){
  echo "</html>";
}

?>