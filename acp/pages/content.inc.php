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

if (isset($_POST['saveContent'])) {
    \Classes\Page::saveContent($_POST);
}

?>

<html>
    <head>
        <title>pCMS ACP</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="../js/vendor/jquery-ui.css" />
        <script src="../js/vendor/jquery-1.8.3.js"></script>
        <script src="../js/vendor/jquery-ui.js"></script>
        <script>
        function check(id, content) {
            $(function() {
                document.getElementById('edit').innerHTML = content;    
                document.getElementById('ContId').value = id;
                document.getElementById('editDialog').style.display='block';
                $( "#editDialog" ).dialog();   
                $( "#editDialog" ).dialog({ minWidth: 700 });    
                $( "#editDialog" ).dialog({ minHeight: 600 });             
              });
        }
        </script>
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
            <li class="current"><a href="?p=content">Inhalte</a></li>
            <li><a href="?p=plugins">Plugins</a></li>
            <li><a href="#">Referenzen</a></li>
            <li><a href="?p=logout">Logout</a></li>
        </ul>

        <div id="main">
            <div class="contentlist">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Variable</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
<?
                        $page = new \Classes\Page('Default');
                        $data = $page->getData();

                        foreach ($data as $key => $value) {
?>
                        <tr>
                            <td><?=$value['id']?></td>
                            <td><?=$value['variable']?></td>
                            <td>
                                <select name="opt" onchange="check('<?=$value['id']?>', '<?=$value['value']?>')">
                                    <option>Option w&auml;hlen</option>
                                    <option value="<?=$value['id']?>">bearbeiten</option>
                                </select>
                            </td>
                        </tr>
<?
                        }
?>
                    </tbody>
                </table>
            </div>

            <div id="editDialog" title="Content Edit" style="display:none;min-width:600px;">
                <form action="?p=content" method="post">
                    <input type="hidden" name="ContId" id="ContId">
                    <p></p>
                    <textarea name="contentData" id="edit" style="width:600px;height:500px;"></textarea><br>
                    <input type="submit" name="saveContent" value="Speichern" class="button">
                </form>
            </div>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
