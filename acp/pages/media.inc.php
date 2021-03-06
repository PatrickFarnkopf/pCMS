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

?>

<html>
    <head>
        <title>pCMS ACP</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    </head>
    <body>
        <div class="logo">
            <h1><span class="bing">p</span>CMS</h1>
        </div>

        <ul id="nav">
            <li><a href="?p=main">&Uuml;bersicht</a></li>
            <li><a href="?p=user">Benutzer</a></li>
            <li class="current"><a href="?p=media">Medien</a></li>  
            <li><a href="?p=styles">Styles</a></li>
            <li><a href="?p=content">Inhalte</a></li>
            <li><a href="?p=plugins">Plugins</a></li>
            <li><a href="#">Referenzen</a></li>
            <li><a href="?p=logout">Logout</a></li>
        </ul>

        <div id="main">
            <div id="dropArea">Dateien in das Feld ziehen</div>

            <div class="infoUp">
                <input id="url" type="hidden" value="pages/uploader.php">
            </div>
            <br><br>
            <div id="images">
                <?php
                    $dir = new \Classes\Directory('../media/uploads');
                    $files = $dir->getFiles();

                    for ($i=0, $c=0;$i<count($files);$i++, $c++) {
                        if ($c < 3)
                            echo '<div class="viertel-box"><img src="../media/uploads/'.$files[$i].'"></div>'."\n";
                        else {
                            echo '<div class="viertel-box lastbox"><img src="../media/uploads/'.$files[$i].'"></div>'."\n";
                            echo '<div style="clear: both;"></div>';
                            $c = -1;
                        }
                    }
                    echo '<div style="clear: both;"></div>';

                ?>

            </div>
        </div>
        <script src="../js/script.js"></script>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
