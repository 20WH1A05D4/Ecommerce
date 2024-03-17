<?php

require("database.php");
include 'vendor/autoload.php';
use \Firebase\JWT\JWT;

//Get the email and password from the user through login page
$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);
$password = $_POST['password'];
$password = mysqli_real_escape_string($conn, $password);
// Query checks if the email and password are present in the database.
$query = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
$result = mysqli_query($conn, $query)or die($mysqli_error($conn));
$num = mysqli_num_rows($result);
// If the email and password are not present in the database, the mysqli_num_rows returns 0, it is assigned to $num.
/*if ($num == 0) {
  $error = "<span class='red'>Please enter correct E-mail id and Password</span>";
  header('location: login.php?error=' . $error);
} else {  */
  $row = mysqli_fetch_array($result);
  $username = $row['username'];
  echo "<h1>$username</h1>";
  $email = $row['email'];
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $email;
  // JWT TOKEN
  $payload = [
    'iss' => "localhost",
    'aud' => 'localhost',
    'exp' => time() + 1000,
    $data = [
        "username" => $username,
        "email" => $email,
    ],
  ];
  $secret_key = "Seekruthi";
  $token = JWT::encode($payload, $secret_key, 'HS256');
  $_SESSION['jwt_token'] = $token;
  if ($row['role']=='admin') {
    $_SESSION['role']='admin';
    header('location: admin.php');
  } else {
    header('location: index.php');
  }
//}
?>
