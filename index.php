<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<div class="content">
		<?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome, user!</p>
			<p> <a href="index.php?logout='1'" style="color: #d6b0de;">Logout</a> </p>
		<?php else: ?>
			<p>Must login first!</p>
			<p> <a href="login.php" style="color: #d6b0de;"> Here </a> </p>	
		<?php endif ?>
	</div>
</body>
</html>
