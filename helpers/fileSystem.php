<?php
	include_once '../config.php';
	function getFullDirName($dir)
	{
		$_SERVER['DOCUMENT_ROOT'] . _APPROOT . "\\". $_dir;
	}

	function getDirectoryContents($dir)
	{
		$result = array();
		$result["dir"] = array();
		$result["file"] = array();
		$oIterator = new DirectoryIterator(dirname(__FILE__));
		foreach ($oIterator as $oFileInfo) 
		{
			if($fileInfo->isDot()) continue;
		    // A directory
		    if ($oFileInfo->isDir())
		    {

		    }
		    else
		    {

		    }
		}
	}
	function hasPermission($user,$path)
	{

	}



?>