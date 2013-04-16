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

if (isset($_POST['saveNav'])) {
    \Classes\Page::saveNav($_POST);
}

if (isset($_GET['delnav'])) {
    \Classes\Page::delNav($_GET['delnav']);
}

if (isset($_POST['addNav'])) {
    \Classes\Page::addNav($_POST);
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

        function addDialog() {
            $(function() {
                document.getElementById('addNavDialog').style.display='block';
                $( "#addNavDialog" ).dialog();   
                $( "#addNavDialog" ).dialog({ minWidth: 300 });    
                $( "#addNavDialog" ).dialog({ minHeight: 200 });             
              });
        }

        function checkNav(id, name, link, type) {
            $(function() {
                if (type == 1) {
                    document.getElementById('navId').value = id;
                    document.getElementById('navName').value = name;
                    document.getElementById('navLink').value = link;
                    document.getElementById('editNavDialog').style.display='block';
                    $( "#editNavDialog" ).dialog();   
                    $( "#editNavDialog" ).dialog({ minWidth: 300 });    
                    $( "#editNavDialog" ).dialog({ minHeight: 200 });      
                } else if (type == 2) {
                    document.getElementById('del').innerHTML = "<a href='?p=content&delnav="+id+"' class='jbutton'>L&ouml;schen</a>";
                    document.getElementById('deleteDialog').style.display='block';
                    $( "#deleteDialog" ).dialog();  
                }       
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
<br><br>
            <div class="contentlist">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
<?
                        $page = new \Classes\Page('Default');
                        $data = $page->getNavData();

                        foreach ($data as $key => $value) {
?>
                        <tr>
                            <td><?=$value['id']?></td>
                            <td><?=$value['name']?></td>
                            <td><?=$value['link']?></td>
                            <td>
                                <select name="opt" onchange="checkNav('<?=$value['id']?>', '<?=$value['name']?>', '<?=$value['link']?>', this.value)">
                                    <option>Option w&auml;hlen</option>
                                    <option value="1">bearbeiten</option>
                                    <option value="2">l&ouml;schen</option>
                                </select>
                            </td>
                        </tr>
<?
                        }
?>
                    </tbody>
                </table>
                <br><br>
                <div align=center><button class="button" onclick="addDialog()">Link hinzuf&uuml;gen</button></div>
            </div>

            <div id="editDialog" title="Content Edit" style="display:none;min-width:600px;">
                <form action="?p=content" method="post">
                    <input type="hidden" name="ContId" id="ContId">
                    <p></p>
                    <textarea name="contentData" id="edit" style="width:600px;height:500px;"></textarea><br>
                    <input type="submit" name="saveContent" value="Speichern" class="button">
                </form>
            </div>

            <div id="editNavDialog" title="Navigation Edit" style="display:none;">
                <form action="?p=content" method="post">
                    <input type="hidden" name="navId" id="navId" class="coolText">
                    <input type="text" name="navName" id="navName" placeholder="Name" class="coolText"><br>
                    <input type="text" name="navLink" id="navLink" placeholder="Link" class="coolText"><br>
                    <input type="submit" name="saveNav" value="Speichern" class="button">
                </form>
            </div>

            <div id="addNavDialog" title="Navigation Add" style="display:none;">
                <form action="?p=content" method="post">
                    <input type="text" name="navName" placeholder="Name" class="coolText"><br>
                    <input type="text" name="navLink" placeholder="Link" class="coolText"><br>
                    <input type="submit" name="addNav" value="Speichern" class="button">
                </form>
            </div>

            <div id="deleteDialog" title="Link l&ouml;schen" style="display:none;">
                <br>Link entfernen<br><br>
                <p id="del"></p>
            </div>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
