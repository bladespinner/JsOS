<?php
	function getDirectoryContents($dir)
	{
			$contents = scandir($dir);
			$result = array();
			$result['folders'] = array();
			$result['files'] = array();
			foreach($contents as $item)
			{

				if(is_dir($dir."/".$item))
				{

					if($item==='.' || $item==='..')continue;
					$result['folders'][] = $item;
				}
				else 
					$result['files'][] = $item;
			}
			return $result;

	}