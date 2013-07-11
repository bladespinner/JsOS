<?php
include_once './upload_file.php'
?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
		<script src="style.js"></script>
		<link rel="stylesheet" type="text/css" href="../test.css">
	</head>
	<body>
		<div class="paper">
		
			<div class="content">
				<h1> Admin Panel </h1>
					<label>Insert program name:</label>
					<form  method="post" enctype="multipart/form-data">
					<input type="text" name="programName"></input>
					<?php if(isset($createProgram) && !$createProgram) echo "<br/> <h5> Error by creating a program. Try with another name. </h5> </br>";
					?>
					<br/>
					<label for="file"> Fiename: </label>
					<br/>
					<input type="file" name="file0" id="file"> </br></br>
					<?php if(isset($validFiles) && !$validFiles) echo "<br/> <h5>You have to upload at least one valid file. </h5> </br>";
					?>
					<a href=""> Upload more </a> <br/><br/>

					<input type="submit" name="submit" value="Submit">
					<?php   if( isset($okStatus) && $okStatus) 
					 echo "<br/> <h3> Program created  successfull. </h3> </br>";
					?>
					</form>	
			</div>
			
			<footer>
				<a href="OS.html">JsOS</a> | <a href="login.html">Login</a> | <a href="register.html">Register</a> | <a href="about.html">About</a> | <a href="index.html">Home</a> | <a href="disclaimer.html">Disclaimer</a> <span> | JsOS © All Rights Reserved
			</footer>
		</div>
	</body>
</html>