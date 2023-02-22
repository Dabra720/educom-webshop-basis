<?php
echo 'Inhoud van users.txt: ';
$users_file = fopen('users/users.txt', 'a+') or die("Unable to open file!");

$new_user = "dbraas@gmail.com|Daan Braas|test123";
fwrite($users_file, "\n" . $new_user);
fclose($users_file);

$users_file = fopen('users/users.txt', 'r');
while(!feof($users_file)){
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