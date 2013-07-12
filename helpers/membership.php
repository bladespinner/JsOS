<?php
	function isAlphanumeric($str,$allowSpecialSymbols)
	{
		for($i = 0 ; $i < strlen($str);$i++)
		{
			$ch = $str[$i] ;
			$isLowercaseLetter = ($ch >= 'a') && ($ch <= 'z') ;
			$isUppercaseLetter = $ch >= 'A' && $ch <= 'Z' ;
			$isNumber = $ch >= '0' && $ch <= '9' ;
			$isSpecial = false;
			if($allowSpecialSymbols)
			{
				$isSpecial = $ch == '@' || $ch == '!';
			}
			if(!$isLowercaseLetter && !$isUppercaseLetter && !$isNumber && !$isSpecial)
			{
				return false;
			}
		}
		return true;
	}
	function generateRndSalt()
	{
		$result = "";
		$saltLen = 15;
		for($i=0;$i<$saltLen;$i = $i + 1)
		{
			$result = $result . (chr(rand(ord('a'),ord('z'))));
		}
		return $result;
	}
	function hashPassword($password , $salt)
	{
		return sha1($password . $salt);
	}
	function register($con,$username,$password)
	{
		echo $username;
		$salt = generateRndSalt();
		$password = hashPassword($password , $salt);
		$username = mysql_real_escape_string($username);
		$sql = "INSERT INTO `user`(`UserName`, `Hash`, `Salt`) VALUES ('" .$username. "','" .$password. "','" .$salt. "')";
		if(!mysqli_query($con, $sql))
		{
			//die("Error:".mysqli_error($con));
			return false;
		}
		createFilesystem($username);
		return true;
	}

	function createFilesystem($username)
	{
		$userDir = "fileSystem/".$username;
		mkdir($userDir);
		mkdir($userDir . "/Desktop");
		mkdir($userDir . "/System");
		mkdir($userDir . "/User");
	}
	function isLoggedIn()
	{
		if(array_key_exists('loggedIn',$_SESSION))
		{
			return $_SESSION['loggedIn'];
		}
		return false;
	}
	function logout()
	{
		session_start();
		session_destroy();
	}
	function login($con,$username,$password)
	{
		$username = mysql_real_escape_string($username);
		$sql = "SELECT * FROM `user` where `UserName` ='".$username."'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		if($row)
		{
			$hash = hashPassword($password,$row['Salt']);
			$role=$row['Role'];
			if($hash === $row['Hash'])
			{
				setLoggedIn($username);
				return true;
			}
			else return false;
		}
		return false;

	}
	function validNames($username,$password,$passwordRepeat)
	{
		$sufficientPassLen = strlen($username)>=7;
		$sufficientUsrNameLen = strlen($password)>=4;
		$passwordsMatch = $password === $passwordRepeat;
		return isAlphanumeric($username,false) &&
			   isAlphanumeric($password,true) &&
			   $sufficientPassLen &&
			   $passwordsMatch &&
			   $sufficientUsrNameLen;
	}
	function setLoggedIn($username,$role)
	{
		$_SESSION['username'] = $username;
		$_SESSION['loggedIn'] = true;
		$_SESSION['role']=$role;
	} 
?>