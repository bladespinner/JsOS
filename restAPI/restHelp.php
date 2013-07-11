<?php
	include_once dirname(__FILE__) .'\..\config.php';
	include_once dirname(__FILE__) .'\..\helpers\membership.php';

	function deleteDirectory($dir) {
	    if (!is_dir($dir) || is_link($dir)) return unlink($dir); 
	        foreach (scandir($dir) as $file) { 
	            if ($file == '.' || $file == '..') continue; 
	            if (!destroy_dir($dir . DIRECTORY_SEPARATOR . $file)) { 
	                chmod($dir . DIRECTORY_SEPARATOR . $file, 0777); 
	                if (!destroy_dir($dir . DIRECTORY_SEPARATOR . $file)) return false; 
	            }; 
	        } 
	        return rmdir($dir); 
	}

	function joinPaths() {
	    $args = func_get_args();
	    $paths = array();
	    foreach ($args as $arg) {
	        $paths = array_merge($paths, (array)$arg);
	    }

	    $paths = array_map(create_function('$p', 'return trim($p, "/");'), $paths);
	    $paths = array_filter($paths);
	    return join('/', $paths);
	}
	function copyRecursive($source, $dest)
	{
		
	    if(is_dir($source)) 
	    {
	    	if(!file_exists($dest))
	    	{
	    		if(!mkdir($dest))return false;
	    	}
	        $dir_handle=opendir($source);
	        while($file=readdir($dir_handle))
	        {
	            if($file!="." && $file!="..")
	            {
	                if(is_dir($source."\\".$file))
	                {
	                    if(!mkdir($dest."\\".$file))return false;
	                    if(!cpy($source."\\".$file, $dest."\\".$file))return false;
	                } 
	                else 
	                {
	                    if(!copy($source."\\".$file, $dest."\\".$file))return false;
	                }
	            }
	        }
	        closedir($dir_handle);
	    } 
	    else 
	    {
	        if(!copy($source, $dest))return false;
	    }
	    return true;
	}
	function translatePath($dir)//path is like : Disk\.........
	{
		if(!isLoggedIn())return false;

		$dir = substr($dir,5);//remove 'Disk\' part

		$dir = joinPaths($_SERVER['DOCUMENT_ROOT'],_USERFILESYS,$_SESSION['username'],$dir);
		$dir = str_replace('/', '\\', $dir);
		return $dir;
	}
	function hasAccess($dir)
	{
		if(!isLoggedIn())return false;

		$dir = translatePath($dir);
		
		
		while(!file_exists($dir))
		{
			if($dir!="")
			{
				$info = pathinfo($dir);
				$dir = $info["dirname"];
			}
			else return false;
		}

		$baseDir = joinPaths($_SERVER['DOCUMENT_ROOT'] , _USERFILESYS, $_SESSION['username']);
		$baseDir = str_replace('/', '\\', $dir);
		if (strpos($dir,$baseDir) === 0) return true;
		return false;
	}



	$_PUT = array();
	$_DELETE = array();
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

	if($_SERVER['REQUEST_METHOD'] === 'PUT')
	{
		parse_str(file_get_contents("php://input"),$_PUT);
	}
	else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
	{
		parse_str(file_get_contents("php://input"),$_DELETE);
	}
?>