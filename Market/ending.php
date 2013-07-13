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
		<script src="style.js"></script>
		<link rel="stylesheet" type="text/css" href="../test.css">
	</head>
	<body>
		<div class="paper">
		
			<div class="content">
				<h1><a href="adminPanel.php"> Admin Panel <a></h1>
				<?php 
					if(isset($_GET['okStatus']) && $_GET['okStatus']==='1')
						echo "<h3>Files uploaded successfull.";
					else if(isset($_GET['okStatus']) && $_GET['okStatus']==='')
						echo "<h3>Something went wrong :(";
					else if(isset($_GET['validFiles']) && $_GET['validFiles']==='')
						echo "<h3>No files uploaded.";
						?>

			</div>
			
			<?php include '../controls/footer.php'; ?>
		</div>
	</body>
</html>