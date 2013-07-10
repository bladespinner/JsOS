<?php
	include_once 'helpers/membership.php';
	include_once 'helpers/db.php';
	include_once 'config.php';
	
	session_start();
	$succesfulLogin = true;
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$con=getDBConnection();
		$succesfulLogin = login($con,$_POST['username'],$_POST['password']);
		if($succesfulLogin)
		{
			header( 'Location: http://localhost:8088/JsOS/JsOS.html' ) ;
		}
	}
?>

<html>
	<head>
		<script src="jquery-1.4.4.min.js"></script>
		<link rel="stylesheet" type="text/css" href="test.css">
	</head>
	<body>
		<div class="paper">
			<div class="content">
				<h1>JsOS - The online operating system!</h1>
				<?php include 'controls/loginbar.php'; ?>
				</br>
				<div class="center">
					<h1>Login</h1>
					<form method="post">
						<input type="text" id="username" name="username"></input>
						<label>Username</label>
						</br>
						</br>
						<input type="password" id="password" name="password"></input>
						<label>Password</label>
						</br>
						</br>
						<input type="submit" value="Login"></input>
						<?php 
							if(!$succesfulLogin)
							{
								echo "<label></br>Wrong Username or Password.</label>";
							}
						?>
					</form>
				</div>
				</br>
			</div>
			<footer>
				<a href="OS.html">JsOS</a> | <a href="login.html">Login</a> | <a href="register.html">Register</a> | <a href="about.html">About</a> | <a href="index.html">Home</a> | <a href="disclaimer.html">Disclaimer</a> <span> | JsOS © All Rights Reserved
			</footer>
		</div>
	</body>
</html>