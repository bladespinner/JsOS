<?php
session_start();
if( !isset($_SESSION['rank']) || $_SESSION['rank']!='admin')
{
http_response_code(403);
exit();
}

?>
<html>
	<head>
		<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../test.css">
	</head>
	<body>
		<div class="paper">
		
			<div class="content">
				<h1> Admin Panel </h1>
				<h3><a href="createProgram.php">Create a new program</a></h3>
				<br/>
				<h3><a href="viewPrograms.php">View a list of programs already in use</a></h3>


			</div>
			
		<?php include '../controls/footer.php'; ?>
		</div>
	</body>
</html>