<?php
include_once './dirContent.php'
?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../test.css">
	</head>
	<body>
		<div class="paper">
		
			<div class="content">
				<h1><a href="adminPanel.php"> Admin Panel <a></h1>
					<?php

						$result=getDirectoryContents("./programs");
						$i=0;
						while(isset($result['folders'][$i]))
						{
							echo "<h3>". $result['folders'][$i]. "<br/></h3>";
							$i++;
						}
					?>
			</div>
			
			<footer>
				<a href="OS.html">JsOS</a> | <a href="login.html">Login</a> | <a href="register.html">Register</a> | <a href="about.html">About</a> | <a href="index.html">Home</a> | <a href="disclaimer.html">Disclaimer</a> <span> | JsOS © All Rights Reserved
			</footer>
		</div>
	</body>
</html>