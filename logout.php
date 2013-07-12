<?php
	include_once 'helpers/membership.php';
	include_once  './config.php';
	logout();
	header( 'Location:http://'.$_SERVER['HTTP_HOST']._APPROOT.'/login.php') ;
	exit();
?>