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
if (!$user->isLoggedIn()) {
    header('Location: ?p=login');
    exit;
}

if (isset($_POST['color']))
    echo $_POST['color'];

?>

<html>
    <head>
        <title>pCMS ACP</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="logo">
            <h1><span class="bing">p</span>CMS</h1>
        </div>
        <ul id="nav">
            <li><a href="?p=main">&Uuml;bersicht</a></li>
            <li><a href="?p=user">Benutzer</a></li>
            <li><a href="?p=media">Medien</a></li>  
            <li class="current"><a href="?p=styles">Styles</a></li>
            <li><a href="#">Inhalte</a></li>
            <li><a href="#">Plugins</a></li>
            <li><a href="#">Referenzen</a></li>
            <li><a href="?p=logout">Logout</a></li>
        </ul>

        <div id="main">
            <h3>Body (gesamte Seite)</h3>
            <table>
                <tr>
                    <td>Hintergrundfarbe</td>
                    <td><form action="?p=styles" method="post"><input type="color" name="color" onchange="submit();" value="#ff0000"></form></td>
                </tr>

                <tr>
                    <td>Schriftfarbe</td>
                    <td><form action="?p=styles" method="post"><input type="color" name="color" onchange="submit();" value="#ff0000"></form></td>
                </tr>
            </table>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
