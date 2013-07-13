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

				    <form action="upload_file.php" method="post" enctype="multipart/form-data">
					<label for="file"><h3>Filename:</h3></label>
					<input type="file" name="file" id="file"><br/><br/>
					<input type="submit" name="submit" value="Submit">
					</form>	
			</div>
			
			<?php include '../controls/footer.php'; ?>
		</div>
	</body>
</html>