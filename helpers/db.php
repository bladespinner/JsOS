<?php
	include_once dirname(__FILE__) .'\..\config.php';
	function getDBConnection()
	{
		return mysqli_connect(_MYSQLSERVER,_MYSQLUSER,_MYSQLPASSWORD,_MYSQLDATABASE);
	}
?>