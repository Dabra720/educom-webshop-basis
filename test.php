<?php
// Debug tool, om variabelen makkelijk te kunnen checken
function debug_to_console($data) {
  $output = $data;
  if (is_array($output))
      $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "');</script>";
}

echo 'Inhoud van users.txt: ';
$users_file = fopen('users/users.txt', 'a+') or die("Unable to open file!");

// $user_email = "dbraas@gmail.com";
// $user_name = "Daan Braas";
// $user_password = "test123";
// $array = array($user_email, $user_name, $user_password);

// $new_user = implode("|", $array);

// fwrite($users_file, "\n" . $new_user);
// fclose($users_file);

$users_file = fopen('users/users.txt', 'r');
while(!feof($users_file)){
	$str = fgets($users_file);
	debug_to_console("password: ". $str[0]."+" . $str[1]."+".$str[2]);
  echo fgets($users_file) . '<br>';
}
// echo fread($users_file, filesize('users/users.txt'));

echo '<span class="error">* required fields</span>
	<form action="" method="POST">
		E-Mail: <input type="text" name="email" value=""><span class="error">*</span>
		<br><br>
    Naam: <input type="text" name="name" value=""><span class="error">*</span>
		<br><br>
		Wachtwoord: <input type="text" name="password" value=""><span class="error">*</span>
		<br><br>
    Herhaal wachtwoord: <input type="text" name="pass_rep" value=""><span class="error">*</span>
    <br><br>
		<input type="hidden" name="page" value="registration">
		<input type="submit">
	</form>';
?>