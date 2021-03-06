<?php
	include_once "helpers/membership.php";
	session_start();
	if(!isLoggedIn())
	{
		http_response_code(403);
		header( 'Location: http://localhost:8088/JsOS/login.php' ) ;
	}
?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
		<script src="resources/jquery.horizontal.scroll.js"></script>
		<script src="resources/jquery.fullscreen-0.3.5.min.js"></script>
		<script src="resources/api.js"></script>
		<script src="resources/window.js"></script>
		<script src="resources/desktop.js"></script>
		<link rel="stylesheet" type="text/css" href="resources/defWindowStyle.css">
		<link rel="stylesheet" type="text/css" href="resources/jquery.horizontal.scroll.css">
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css"/>
	</head>
	<body onload="init()">
		<input type="hidden" id="username" value='<?php echo $_SESSION['username']; ?>' ></input>
		<div id="desktop">
			<div id="startMenu">
				<button id="fullscrnBtn" class="menubtn">Toggle Fullscreen</button>
				<button id="marketBtn" class="menubtn">Market</button>
				<button id="fileSysBtn" class="menubtn">File System</button>
				<a href="logout.php">
					<button id="logoutBtn" class="menubtn">Logout</button>
				</a>
				<a href="http://www.noviizbori2013.com" target="_blank">
					<img src="http://noviizbori2013.com/images/resignation-button-bg.png" alt="Поискай оставка!" style="margin-left:10px;margin-top:50px" width="180" height="45" />
				</a>
			</div>
			<div id="toolbar">
				<div id="startBtn">
					Start
				</div>

				<div class="seprtr"></div>

				<div id="iconHolder">
					<ul id="innerHolder">

					</ul>
				</div>

				<div id="taskbar">
					<div class="seprtr"></div>

					<div id="datetime">
						00:01 | 11.7.2013
					</div>
				<div>
			</div>
		</div>


		<script>
			$("document").ready(function(){
				LoadSettings();
			})

		</script>

	</body>


</html>