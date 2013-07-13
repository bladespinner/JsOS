<?php
include_once './dirContent.php'
?>
<?php
if(!isset($_SESSION['rank']) ||$_SESSION['rank']!='admin')
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
				<h1><a href="adminPanel.php"> Admin Panel </a></h1>
					<?php
						if(isset( $_GET['success']) && $_GET['success']==='1')
						{
							echo '<h3> File deleted successfull.</h3>';
						}
						else if(isset($_GET['success']) && $_GET['success']==='')
						{
							echo '<h3>Operation failed.</h3>';
						}

						$result=getDirectoryContents("./programs");
						$i=0;
						while(isset($result['folders'][$i]))
						{
							echo "<h3>Program: ". $result['folders'][$i]. "<br/></h3>";
							echo '<form method="post" action="viewProgram.php">';
							echo '<input type="hidden" name="fileName" value="'.$result['folders'][$i].'" ></input>';
							echo '<input type="submit" value="Change"></input>';
							echo '</form>';
							echo '<form method="post" action="deleteHoleProgram.php">';
							echo '<input type="hidden" name="dirName" value="./programs/'.$result['folders'][$i].'" ></input>';
							echo '<input type="submit" value="Delete" ></input>';
							echo '</form>';

							echo '<form method="post" action="updateProgram.php">';
							echo '<input type="hidden" name="programName" value="'.$result['folders'][$i].'" ></input>';
							echo '<input type="submit" value="Add more files" ></input>';
							echo '</form>';
							$i++;
						}
							


							
					?>
			</div>
			
			<?php include '../controls/footer.php'; ?>
		</div>
	</body>
</html>