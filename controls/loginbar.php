<aside>
<?php
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
	if(isLoggedIn())
	{
		echo $_SESSION["username"]." | <a href=\"logout.php\">Logout</a><br/>" ;
	}
	else
	{
		echo "<a href=\"login.php\">Login</a>";
	}
	if(isLoggedIn() && $_SESSION['rank']==='admin')
		echo '<a href="http://'.$_SERVER['HTTP_HOST']._APPROOT.'/Market/adminPanel.php"> Admin panel </a>';
		
?> 	
</aside>