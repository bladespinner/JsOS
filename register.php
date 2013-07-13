
<?php
	include_once 'helpers/membership.php';
	include_once 'helpers/db.php';
	include_once 'config.php';
	
	session_start();
	$registerSuccess = false;
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if(validNames($_POST["username"],$_POST["password"],$_POST["passwordRepeat"]))
		{
			$con=getDBConnection();
			if (mysqli_connect_errno($con))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				exit();
			}
			
			$registerSuccess = register($con,$_POST["username"],$_POST["password"]);
			if($registerSuccess)
			{
				setLoggedIn($_POST["username"]);

				header( 'Location: http://'.$_SERVER['HTTP_HOST']._APPROOT.'/JsOS.php') ;
				exit();
			}
		}
	}

?>

<html>
	<head>
		<script src="jquery-1.4.4.min.js"></script>
		<script src="inputStyle.js"></script>
		<link rel="stylesheet" type="text/css" href="test.css">
	</head>
	<body>
		<div class="paper">
			<div class="content">
				<h1>JsOS - The online operating system!</h1>
				<?php include 'controls/loginbar.php'; ?>
				</br>

				<div class="center">
					<h1>Register</h1>
					<form method="post">
						<input type="text" id="username" name="username" value="Insert username" data-defaultValue="Insert username"></input>
						<label>Username</label>
						</br>
						</br>
						<input type="password" id="password" name="password" value="*******" data-defaultValue="*******"></input>
						<label>Password</label>
						</br>
						</br>
						<input type="password" id="passwordRepeat" name="passwordRepeat"  value="*******" data-defaultValue="*******"></input>
						<label>Repeat Password</label>
						</br>
						<label id="passMissmatchLabel"></br>Passwords must match.</label>
						<label id="passShortLabel"></br>Password should be atleast 7 simbols.</label>
						<label id="userShortLabel"></br>Username should be atleast 4 simbols.</label>
						<label id="fieldAlphanumericLabel"></br>All field characters should be alphanumeric or ! , @ , - , _ </label>
						<?php 
							if(!$registerSuccess && $_SERVER['REQUEST_METHOD'] === 'POST')
							{
								echo("<label></br>Username ".$_POST["username"]." is already taken.</label>");
							}
						?>
						</br>
						</br>
						<input id="regBtn" type="submit" value="Register"></input>
					</form>
				</div>
				<script>

					function isAlphanumeric(str)
					{
						var isLetter = function(c){
							return (c>='a' && c<='z') || (c>='A' && c<='Z')
						}
						var isNumber = function(c){
							return c>='0' && c<='9'
						}
						var isMetasymbol = function(c) {
							return c=='_' || c=='@' || c=='-' || c=='!'
						}
						for(var i=0;i<str.length;i++)
						{
							if(isLetter(str[i])||isNumber(str[i])||isMetasymbol(str[i]))continue;
							else return false;
						}
						return true;
					}
					$(document).ready(function(){
						var passMissm = document.getElementById("passMissmatchLabel");
						var passShort = document.getElementById("passShortLabel");
						var userShort = document.getElementById("userShortLabel");
						var fieldAlphanumeric = document.getElementById("fieldAlphanumericLabel")
						$(passMissm).hide();
						$(passShort).hide();
						$(userShort).hide();
						$(fieldAlphanumeric).hide();
						$("form").submit(function(e){
							var user = document.getElementById("username");
							var pass = document.getElementById("password");
							var rePass = document.getElementById("passwordRepeat");
							$("label").hide();
							if(pass.value !== rePass.value)
							{
								$(passMissm).show();
								e.preventDefault();
							}
							if(pass.value.length < 7)
							{
								$(passShort).show();
								e.preventDefault();
							}
							if(user.value.length<4)
							{
								$(userShort).show();
								e.preventDefault();
							}
							if(!isAlphanumeric(pass.value)||!isAlphanumeric(user.value))
							{
								$(fieldAlphanumeric).show();
								e.preventDefault();
							}
							
						})
					});
				</script>
				</br>
			</div>
			
					<?php include 'controls/footer.php'; ?>
		
		</div>
	</body>
</html>