<?php 
include_once './dirContent.php';
$flag=false;
	if($_SERVER['REQUEST_METHOD']==='POST')
	{
		
		if(is_dir($_POST['dirName']))
		{
			deleteDirectory($_POST['dirName']);
			$flag=true;		
		}
		
	 	header('Location: viewPrograms.php?success='.$flag);
	}
header('Location: viewPrograms.php?success='.$flag);