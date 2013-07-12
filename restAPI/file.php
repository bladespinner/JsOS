<?php
	include_once "restHelp.php"
	function getFile($path)
	{
		return getBase64File($path)
	}

	function postFile($path,$file,$format,$copyPath)
	{
		if($format == "base64")
		{
			return writeBase64File($path,$file)
		}
		else
		{
			if(hasAccess($path))
			{
				$path = translatePath($path);
				return file_put_contents($path,base64_decode($file));
			}
		}
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
		$result = getFile($info["path"]);
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