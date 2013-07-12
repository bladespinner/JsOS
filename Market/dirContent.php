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
	function deleteDirectory($dir) {
	    if (!is_dir($dir) || is_link($dir)) return unlink($dir); 
	        foreach (scandir($dir) as $file) { 
	            if ($file == '.' || $file == '..') continue; 
	            if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $file)) { 
	                chmod($dir . DIRECTORY_SEPARATOR . $file, 0777); 
	                if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $file)) return false; 
	            }; 
	        } 
	        return rmdir($dir); 
	    }