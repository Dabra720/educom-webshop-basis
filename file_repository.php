<?php
require 'connectDB.php';

// function findUserByEmail($email){
//   $users_file = fopen("users/users.txt", "a+");
//   while(!feof($users_file)){
//     $str = explode("|", fgets($users_file));
//     if($str[0]==$email){
//       return $str;
//     }
//   }
//   fclose($users_file);
//   return NULL;
// }

// function saveUser($email, $name, $password){
//   $users_file = fopen("users/users.txt", "a+");
//   $user_data = implode("|",array($email, $name, $password));

//   fwrite($users_file, "\n" . $user_data);
//   fclose($users_file);
// }

function findUserByEmail($email){
  $conn = databaseConnection();
  $sql = "SELECT * FROM users WHERE email='".$email."'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)){
      if($row['email']==$email){
        return $row;
      }
    }
  }
  mysqli_close($conn);
  return NULL;
}

function saveUser($email, $name, $password){
  $conn = databaseConnection();
  $sql = "INSERT INTO users(name, email, password) VALUES('".$name."', '".$email."', '".$password."')";

  mysqli_query($conn, $sql);

  mysqli_close($conn);

}

?>