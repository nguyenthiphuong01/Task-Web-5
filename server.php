<?php
session_start();

$username = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'login_db');

if (isset($_POST['reg_user'])) {
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  //$password = mysqli_real_escape_string($db, $_POST['password']);
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password);

  	$query = "INSERT INTO users (username, password) 
  			  VALUES('$username', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  //$password = mysqli_real_escape_string($db, $_POST['password']);
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password");
  	}
  }
}

?>
