<?php


	function GetMarketProgram($which)
	{
		if($which === "")
		{
			$contents = scandir("../Market/programs");
			$result = array();
			foreach($contents as $item)
			{
				
				if(is_dir("../Market/programs/".$item))
				{
					if($item==='.' || $item==='..')continue;
					$result[] = $item;
				}
			}
			return $result;
		}
		else
		{
			$dirs=realpath("../Market/programs/".$which);
			if(basename(dirname($dirs))!=="programs")return false;
			else
			{
				return file_get_contents($dirs."/main.js");
			}
		}
	}
	$result = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		$info = $_POST['json'];

	}
	else if($_SERVER['REQUEST_METHOD'] === 'GET')
	{
		
		$info = $_GET['json'];
		$result = GetMarketProgram($info["item"]);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'PUT')
	{

	}
	else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
	{

	}
	echo json_encode($result);


?>