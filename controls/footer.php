<?php	 				#Application root 
include_once '/helpers/membership.php';
?>
<footer>
	<a href="JsOS.php">JsOS</a>  <?php if(!isLoggedIn()) echo' |<a href="login.php">Login</a>'?> <?php if(!isLoggedIn()) echo '|<a href="register.php">Register</a>' ?>| <a href="about.php">About</a> | <a href="index.php">Home</a> | <a href="disclaimer.php">Disclaimer</a> <span> | JsOS © All Rights Reserved
</footer>