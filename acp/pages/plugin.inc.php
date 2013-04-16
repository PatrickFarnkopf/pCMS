<?php

/**
* Licensed under tde Apache License
*
* @copyright Copyright 2013 Patrick Farnkopf
* @link https://gitdub.com/PatrickFarnkopf/pCMS
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

$user = new \Classes\User();
if (!$user->isLoggedIn()) {
    header('Location: ?p=login');
    exit;
}

if (isset($_POST['addPlugin'])) {
    \Classes\Plugin::install($_POST['repo'], isset($_POST['install']));
}

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
            <li><a href="?p=styles">Styles</a></li>
            <li><a href="?p=content">Inhalte</a></li>
            <li class="current"><a href="?p=plugins">Plugins</a></li>
            <li><a href="#">Referenzen</a></li>
            <li><a href="?p=logout">Logout</a></li>
        </ul>

        <div id="main">
            <div class="pluginlist">
                <h2>Installierte Plugins</h2>
                <table style="max-width:60%">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Version</th>
                            <th>Status</th>
                        </tr>
                </thead>
                <tbody>
                <?
                $data = \Classes\Plugin::getInstalledPlugins();
                foreach ($data as $key => $value) {
                ?>

                    <tr>
                        <td><?=$value['id']?></td>
                        <td><?=$value['name']?></td>
                        <td><?=$value['version']?></td>
                        <td><?=$value['installed']?'aktiv':'inaktiv'?></td>
                    </tr>

                <?
                }
                ?>
            </tbody>
                </table>
            </div>
            <div class="plugininstall">
                <h2>Plugin installieren</h2>
                <form action="?p=plugins" method="post">
                    <input type="text" name="repo" placeholder="Repository URL"><br>
                    direkt aktivieren? <input type="checkbox" name="install" value="1"><br><br>
                    <input type="submit" name="addPlugin" value="Plugin installieren" class="button">
                </form>
            </div>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
