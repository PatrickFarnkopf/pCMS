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

if (isset($_POST['save'])) {
    $style = new \Classes\Style(1);
    $style->saveToDB($_POST);
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
            <li class="current"><a href="?p=styles">Styles</a></li>
            <li><a href="#">Inhalte</a></li>
            <li><a href="?p=plugins">Plugins</a></li>
            <li><a href="#">Referenzen</a></li>
            <li><a href="?p=logout">Logout</a></li>
        </ul>

        <div id="main">
            
            <form action="?p=styles" method="post">
            <?php
                $style = new \Classes\Style(1);
                $styles = $style->getData();
                foreach ($styles as $data) {
                    ?>
                    <h3><?=$data[0]['declName']?></h3>
                    
                    <table>
                        
                            
                            <?
                                foreach ($data['attr'] as $value) {
                            ?>
                                <tr>
                                <td><?=$value['attr']?></td>
                                <td>

                                    <?
                                    switch ($value['attr']) {
                                        case 'background-color': ?>
                                        <input type="color" name="<?=$value['id']?>" value="<?=$value['value']?>">
                                        <?
                                        break;
                                        case 'color': ?>
                                        <input type="color" name="<?=$value['id']?>" value="<?=$value['value']?>">
                                        <?
                                        break;
                                        case 'margin': ?>
                                        <input type="text" name="<?=$value['id']?>" value="<?=$value['value']?>">
                                        <?
                                        break;
                                        case 'margin-top': ?>
                                        <input type="number" name="<?=$value['id']?>" value="<?=$value['value']?>" min="1" max="5000">
                                        <?
                                        break;
                                        case 'margin-bottom': ?>
                                        <input type="number" name="<?=$value['id']?>" value="<?=$value['value']?>" min="1" max="5000">
                                        <?
                                        break;
                                        case 'margin-left': ?>
                                        <input type="number" name="<?=$value['id']?>" value="<?=$value['value']?>" min="1" max="5000">
                                        <?
                                        break;
                                        case 'margin-right': ?>
                                        <input type="number" name="<?=$value['id']?>" value="<?=$value['value']?>" min="1" max="5000">
                                        <?
                                        break;
                                        case 'text-align': ?>
                                        <select name="<?=$value['id']?>" value="<?=$value['value']?>">
                                            <option value="left" <?php if($value['value']=='left') echo 'selected="selected"'; ?>>Links</option>
                                            <option value="center" <?php if($value['value']=='center') echo 'selected="selected"'; ?>>Mitte</option>
                                            <option value="right" <?php if($value['value']=='right') echo 'selected="selected"'; ?>>Rechts</option>
                                        </select>
                                        <?
                                        break;
                                        case 'float': ?>
                                        <select name="<?=$value['id']?>" value="<?=$value['value']?>">
                                            <option value="left" <?php if($value['value']=='left') echo 'selected="selected"'; ?>>Links</option>
                                            <option value="right" <?php if($value['value']=='right') echo 'selected="selected"'; ?>>Rechts</option>
                                        </select>
                                        <?
                                        break;
                                        case 'position': ?>
                                        <select name="<?=$value['id']?>" value="<?=$value['value']?>">
                                            <option value="absolute" <?php if($value['value']=='absolute') echo 'selected="selected"'; ?>>absolute</option>
                                            <option value="relative" <?php if($value['value']=='relative') echo 'selected="selected"'; ?>>relative</option>
                                            <option value="fixed" <?php if($value['value']=='fixed') echo 'selected="selected"'; ?>>fixed</option>
                                        </select>
                                        <?
                                        break;
                                        default: ?>
                                        <input type="text" name="<?=$value['id']?>" value="<?=$value['value']?>">
                                        <?
                                        break;
                                    }
                                    ?>

                                </td>
                                </tr>
                            <?
                                }
                            ?>
                            
                    </table>
                    
                    <br>
                    <?
                }
            ?>      <div align=center><input type="submit" name="save" value="Speichern" class="button"></div>
                    </form>
                    
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
