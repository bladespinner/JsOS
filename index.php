<?php
include_once 'helpers/membership.php';
session_start();
?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="test.css">
	</head>
	<body>
		<div class="paper">
			<div class="content">
				<h1>JsOS - The online operating system!</h1>
				<?php include 'controls/loginbar.php'; ?>
				<div>
					<div class="accent">
						<h2>What is JsOS ?</h2>
						JsOS is an browser based desktop operating system which lets you manage files and directories , use programs written specifically for it or create your own programs and application using an easy API!
					</div>
					<div class="accent">
						<h2>What does JsOS Feature?</h2>
						<ul>
							JsOS Has many cool and inovative features , have a look at a list of some of the coolest of them and fall in love with JsOS and its sleek design today ! : 
							</br>
							</br>
							<li>Easy to use interface !</li>
							<li>Online storage file storage !</li>
							<li>An application store where everything is free !</li>
							<li>Easy API for writing your own programs !</li>
							<li>Fun !</li>
						</ul>
					</div>
					</br>
					<div class="accent">
						<h2>Is JsOS really usefull ?</h2>
						Indeed it is, especially if you work from
						several different computers. You have all
						the programs you need and your files easily
						accessible by an simple browser window !
					</div>
					</br>
					</br>
					</br>
					<div class="accent">
						<div class="i">"I was truely amased."</div>
						</br>
						<div class="l">Somebody</div>
					</div>
					<div class="accent">
						<div class="i">"Wonterful."</div>
						<div class="l">Someone</div>
					</div>
					<div class="accent">
						<div class="i">"The best thing that has happened to me."</div>
						<div class="l">Something</div>
					</div>
					<div class="accent">
						<div class="i">"Never gonna use anything else again."</div>
						<div class="l">Japanese Robot</div>
					</div>
					</br></br></br>
				</div>
				<h3><a href="JsOS.php">Try it Now!</a></h3>
			</div>
			
			<?php include 'controls/footer.php'; ?>
		</div>
	</body>
</html>