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
		  header( 'Location: http://'.$_SERVER['HTTP_HOST']._APPROOT.'/JsOS.php') ;
		}
	}

?>

<html>
	<head>
		<script src="jquery-1.4.4.min.js"></script>
		<script src="inputStyle.js"></script>
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
					<?php
						if($_SERVER['REQUEST_METHOD'] === 'GET' && isLoggedIn())
						{
							echo '<h3>You are already logged in :)</h3>';
						}
						else if($_SERVER['REQUEST_METHOD'] === 'GET' && !isLoggedIn())
						{
						echo'<form method="post">
						<input type="text" id="username" name="username" value="Insert username" data-defaultValue="Insert username"></input>
						<label>Username</label>
						</br>
						</br>
						<input type="password" id="password" name="password" value="*******" data-defaultValue="*******"></input>
						<label>Password</label>
						</br>
						</br>
						<input type="submit" value="Login"></input>';
							if(!$succesfulLogin)
							{
								echo "<label></br>Wrong Username or Password.</label>";
							}
					echo '</form>';
					}
					?>
				</div>
				</br>
			</div>
			<footer>
				<a href="OS.html">JsOS</a> | <a href="login.html">Login</a> | <a href="register.html">Register</a> | <a href="about.html">About</a> | <a href="index.html">Home</a> | <a href="disclaimer.html">Disclaimer</a> <span> | JsOS © All Rights Reserved
			</footer>
		</div>
	</body>
</html>