<?php


	function GetMarketProgram($which)
	{
		if($which === "all")
		{
			var $dirs = scandir("../Market");
			return $dirs;
		}
		else
		{
			$dirs=realpath("../Market/".$which);
			if(basename(dirname($dirs))!=="Market")return false;
		}
	}
	$result = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$info = $_POST['json'];
		//if(array_key_exists("copyPath",$info))$result = postFile($info["path"],$info["data"],$info["format"],$info["copyPath"]);
		//else $result = postFile($info["path"],$info["data"],$info["format"],"");
	}
	else if($_SERVER['REQUEST_METHOD'] === 'GET')
	{
		$info = $_GET['json'];
		$result = GetMarketProgram($info["item"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'PUT')
	{
		//$info = $_PUT['json'];
		//$result = renameFile($info["path"],$info["newPath"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
	{
		//$info = $_DELETE['json'];
		//$result = deleteFile($info["path"]);
	}
	echo json_encode($result);


?>