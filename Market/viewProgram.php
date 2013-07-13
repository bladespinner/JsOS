<?php
include_once './dirContent.php'
?>
<?php
if(!isset($_SESSION['rank']) || $_SESSION['rank']!='admin')
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
						else if(isset( $_GET['success']) && $_GET['success']==='')
						{
							echo '<h3>Operation failed.</h3>';
						}
						 if( $_SERVER['REQUEST_METHOD'] === 'POST')
						{
							$result=getDirectoryContents("./programs/".$_POST['fileName']);
							$i=0;
							echo '<h3>Program '.$_POST['fileName'].': </br> </h3>';
							while(isset($result['files'][$i]))
							{
								echo "<h1>". $result['files'][$i]. "<br/></h1>";
								echo '<form method="post" action="deleteProgram.php">';
								echo '<input type="hidden" name="fileName" value="./programs/'.$_POST['fileName'].'/'.$result['files'][$i].'" ></input>';
								echo '<input type="submit" value="Delete" ></input>';
								echo '</form>';
								$i++;
							}
						}


							
					?>
			</div>
			
			<?php include '../controls/footer.php'; ?>
		</div>
	</body>
</html>