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
            

            <?php
                $style = new \Classes\Style(1);
                $styles = $style->getData();
                foreach ($styles as $data) {
                    ?>
                    <h3><?=$data[0]['declName']?></h3>
                    <form action="?p=styles" method="post">
                    <table>
                        
                            
                            <?
                                foreach ($data['attr'] as $value) {
                            ?>
                                <tr>
                                <td><?=$value['attr']?></td>
                                <td><input type="color" name="<?=$value['id']?>" value="<?=$value['value']?>"></td>
                                </tr>
                            <?
                                }
                            ?>
                            
                    </table><br>
                    </form>
                    <?
                }
            ?>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
