<?php 

/**
* Licensed under The Apache License
*
* @copyright Copyright 2013 Patrick Farnkopf
* @link https://github.com/PatrickFarnkopf/pCMS
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

$user = new \Classes\User();
if (isset($_POST['login'])) {
	$user->setUsername($_POST['login']);
	$user->setPassword($_POST['pass']);
	if ($user->auth()) {
		header('Location: ?p=main');
		exit;
	}
}

?>

<html>
	<head>
		<title>pCMS Login</title>
		<link rel="stylesheet" href="css/login.css">
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

