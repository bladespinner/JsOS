<?php
echo "blaaaaaa";
	function getDirectoryContents($dir)
	{
			$contents = scandir($dir);
			$result = array();
			$result['folders'] = array();
			$result['files'] = array();
			var_dump($contents);
			foreach($contents as $item)
			{
				var_dump(is_file($item));
				if(is_dir($item))
				{
					if($item==='.' || $item==='..')continue;
					$result['folders'][] = $item;
				}
				else 
					$result['files'][] = $item;
			}
			return $result;

	}