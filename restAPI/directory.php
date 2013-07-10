<?php
	include_once 'restHelp.php';
	
	session_start();

	function createDirectory($dir,$copyDir)
	{
		if(hasAccess($dir))
		{
			$dir = translatePath($dir);
			if($copyDir!=="")
			{
				if(hasAccess($copyDir))
				{
					$copyDir = translatePath($copyDir);
					if(copyRecursive($dir,$copyDir))return 0;//success
					else return 1;//copy error
				}
				else return -1;//permission error
			}
			else
			{
				if(mkdir($dir))return 0;//success
				else return 1;//create error
			}
		}
		return -1;//permission error
	}
	function renameDirectory($dir,$newName)
	{
		if(hasAccess($dir))
		{
			if(hasAccess($newName))
			{
				$newName = translatePath($newName);
				$dir = translatePath($dir);
				if(rename($dir,$newName))return 0;
				else return 1;
			}
		}
		return -1;
	}
	function getDirectoryContents($dir)
	{
		if(hasAccess($dir))
		{
			$dir = translatePath($dir);
			$contents = scandir($dir);
			$result = array();
			$result['folders'] = array();
			$result['files'] = array();
			foreach($contents as $item)
			{
				if(is_dir($item))
				{
					if($item==='.' || $item==='..')continue;
					$result['folders'][] = $item;
				}
				else $result['files'][] = $item;
			}
			return $result;
		}
		return -1;
	}
	function removeDirectory($dir)
	{
		if(hasAccess($dir))
		{
			$dir = translatePath($dir);
			if(deleteDirectory($dir))return 0;
			else return 1;
		}
		return -1;
	}

	//header('Content-type: application/json');
	$result = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$info = $_POST['json'];
		if(array_key_exists("copyDir",$info))$result = createDirectory($info["dir"],$info["copyDir"]);
		else $result = createDirectory($info["dir"],"");
	}
	else if($_SERVER['REQUEST_METHOD'] === 'GET')
	{
		$info = $_GET['json'];
		$result = getDirectoryContents($info["dir"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'PUT')
	{
		$info = $_PUT['json'];
		$result = renameDirectory($info["dir"],$info["newName"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
	{
		$info = $_DELETE['json'];
		$result = removeDirectory($info["dir"]);
	}
	echo json_encode($result);

?>