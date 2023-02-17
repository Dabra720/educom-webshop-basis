<?php
// define variables and set to empty values
$aanhef = $name = $email = $phone = $communicatie = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $aanhef = test_input($_POST["aanhef"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $communicatie = test_input($_POST["communicatie"]);
  $message = test_input($_POST["message"]);
} else {

}

echo "Welkom " . $aanhef . " " . $name;
echo "<br>";
echo "E-mail: " . $email;
echo "<br>";
echo "Telefoonnr: " . $phone;
echo "<br>";
echo "Communicatievoorkeur: " . $communicatie;
echo "<br>";
echo "Bericht: " . $message;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>