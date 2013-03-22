<?php
//session_start();

/*$user = new User();

if (isset($_POST['login'])) {
	$user->setUsername($_POST['login']);
	$user->setPassword($_POST['pass']);
	$user->auth();
}
*/

?>


<html>
	<head>
		<title>pCMS Login</title>
		<style type="text/css">
			body {
			    background-image: -webkit-linear-gradient(white 0%, #9FBFD2 100%); 
			    background-image: -moz-linear-gradient(white 0%, #9FBFD2 100%); 
			    background-image: -o-linear-gradient(white 0%, #9FBFD2 100%); 
			    background-image: linear-gradient(white 0%, #9FBFD2 100%);
			    font-family: Arial, Helvetica, sans-serif;
			    font-size: 12px;
			    text-align: center;
			    outline: none !important;
			}

			.logo {
				text-shadow: 0 0 2px black;
				text-align: center;
				margin: 0px auto;
			}

			.bing {
				color: darkblue;
			}

			.login {
				border: 1px solid black;
				margin: 0px auto;
				border-radius: 8px;
				box-shadow: 0 0 7px;
				width:300px;
				height:190px;
				background-color: #DDD;
			}

			h1 {
				font-size: 38px;
			}

			input[type=text], input[type=password] {
			    -webkit-border-radius: 3px;
			    -moz-border-radius: 3px;
			    -ms-border-radius: 3px;
			    -o-border-radius: 3px;
			    border-radius: 3px;
			    box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    transition: all 0.5s ease;
			    border: 1px solid #c8c8c8;
			    color: #777;
			    font: 16px 'Ubuntu', Verdana, Geneva, Arial, Helvetica, sans-serif;
			    margin: 0 0 10px;
			    padding: 13px;
			    width: 80%;
			}

			input[type="text"]:focus, input[type="password"]:focus {
			    box-shadow: 0 0 3px #0b75b2 inset;
			    background-color: #fff;
			    border: 1px solid #0b75b2;
			    outline: none;
			}

			::-webkit-input-placeholder  { color:#aaa; }
			input:-moz-placeholder { color:#aaa; }

			.button {
				width:200px;
				padding:8px;
				color:white;
				background: #EEE;
				border-radius: 8px;
				-webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    transition: all 0.5s ease;
			    color:black;
			    border: 1px solid black;
			}

			.button:hover {
				box-shadow: 0 2px 0 grey;
			}

			.footer {
				margin-top: 30px;
				color:#444;
				font-size: 11px;
			}

		</style>
	</head>
	<body>
		<div class="logo">
			<h1><span class="bing">p</span>CMS</h1>
		</div>
		<div class="login">
			<form action="?p=login" method="post" style="margin-top:10%;">
				<input type="text" name="login" placeholder="Benutzername"><br>
				<input type="password" name="pass" placeholder="Passwort"><br>
				<input type="submit" value="anmelden" class="button">
			</form>
		</div>
		<br>
		<div class="footer">
			&copy; Patrick Farnkopf
		</div>
	</body>
</html>

