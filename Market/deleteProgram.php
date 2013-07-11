<?php 
var_dump($_SERVER['REQUEST_METHOD']);
$flag=false;
	if($_SERVER['REQUEST_METHOD']==='POST')
	{
		var_dump($_POST);
		if(is_file($_POST['fileName']))
		{
		 unlink($_POST['fileName']);
		 $flag=true;
		}
		header('Location: viewProgram.php?success='.$flag);
	}
header('Location: viewProgram.php?success='.$flag);