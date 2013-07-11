<?php







?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
		<script src="resources/window.js"></script>
		<script src="resources/desktop.js"></script>
		<link rel="stylesheet" type="text/css" href="resources/defWindowStyle.css">
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css"/>
	</head>
	<body onload="init()">
		<div id="desktop">
			<div id="startMenu"></div>
			<div id="toolbar">
				<div id="startBtn">
					Start
				</div>
				<div class="seprtr">
				</div>
				<div id="taskbar">
					<div class="seprtr">
					</div>
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
			function init(){
				var win = CreateWindow({
					width:500,
					height:300,
					posx:200,
					posy:200,
					resizable:true,
					title:"This is a test window"});
				AddWindow(win);
				var win1 = CreateWindow({
					width:500,
					height:300,
					posx:200,
					posy:200,
					resizable:true,
					title:"This is a test window"});
				AddWindow(win1);
			}
		</script>

	</body>


</html>