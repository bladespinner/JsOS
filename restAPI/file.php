<?php
	include_once "restHelp.php";

	session_start();

	function getFile($path,$format)
	{
		if($format === "base64")
		{
			return getBase64File($path);
		}
		else
		{
			if(hasAccess($path))
			{
				$path = translatePath($path);
				return file_get_contents($path);
			}
		}
		
	}

	function postFile($path,$file,$format,$copyPath)
	{
		if($copyPath!=="")
		{
			if(hasAccess($path))
			{
				if(hasAccess($copyPath))
				{
					$path = translatePath($path);
					$copyPath = translatePath($copyPath);
					$contents = file_get_contents($copyPath);
					return file_put_contents($path,$contents);
				}
				else return -1;
			}
			else return -1;	
		}
		else if($format === "base64")
		{
			return writeBase64File($path,$file);
		}
		else
		{
			if(hasAccess($path))
			{
				$path = translatePath($path);
				return file_put_contents($path,$file);
			}
		}
		return 1;
	}

	function deleteFile($path)
	{
		if(hasAccess($path))
		{	
			$path = translatePath($path);

			return unlink($path);
		}
		else return 1;
	}

	function renameFile($path,$pathCpy)
	{
		if(hasAccess($path))
		{
			if(hasAccess($pathCpy))
			{
				$path = translatePath($path);
				$pathCpy = translatePath($pathCpy);
				if(rename($pathCpy,$newName))return 0;
				else return 1;
			}
		}
	}

	//header('Content-type: application/json');
	$result = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$info = $_POST['json'];
		if(array_key_exists("copyPath",$info))$result = postFile($info["path"],$info["data"],$info["format"],$info["copyPath"]);
		else $result = postFile($info["path"],$info["data"],$info["format"],"");
	}
	else if($_SERVER['REQUEST_METHOD'] === 'GET')
	{
		$info = $_GET['json'];
		$result = getFile($info["path"],$info["format"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'PUT')
	{
		$info = $_PUT['json'];
		$result = renameFile($info["path"],$info["newPath"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
	{
		$info = $_DELETE['json'];
		$result = deleteFile($info["path"]);
	}
	echo json_encode($result);


?>