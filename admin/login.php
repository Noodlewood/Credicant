<?php
session_start();
$username = "dan";
$password = "1234";
if (isset($_POST["username"]) && isset($_POST["password"])) {
	if ($_POST["username"] == $username && $_POST["password"] == $password) {
		$_SESSION["login"] = true;
		header('LOCATION:index.php');
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Credicant Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <div class="form">
  	<form action="login.php" method ="post">
  	<label for="username">Username: </label><input type="username" id="usename" name="username"><br /><br />
  	<label for="password">Password: </label><input type="text" id="password" name="password"><br /><br />
  	<button type ="submit">Login</button>
  </div>
  </body>
</html>