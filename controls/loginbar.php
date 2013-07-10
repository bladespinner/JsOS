<aside>
<?php
	if(isLoggedIn())
	{
		echo $_SESSION["username"]." | <a href=\"logout.php\">Logout</a>" ;
	}
	else
	{
		echo "<a href=\"login.php\">Login</a>";
	}
?>
</aside>