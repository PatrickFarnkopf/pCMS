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

$registerStatus = '<br>';
$deleteStatus = '<br>';

if (isset($_GET['a'])) {
    if ($_GET['a'] === 'register') {
        $newUser = new \Classes\User();
        $newUser->setUsername($_POST['username']);
        $newUser->setPassword($_POST['password']);
        $newUser->setEmail($_POST['email']);

        switch ($newUser->register()) {
            case 1: $registerStatus = 'Benutername existiert bereits'; break;
            case 2: $registerStatus = 'E-Mail existiert bereits'; break;
            case 3: $registerStatus = 'Benutername und E-Mail existieren bereits'; break;
            case 4: $registerStatus = 'Benuter erfolgreich erstellt'; break;
        }
    }
}

if (isset($_GET['delete'])) {
    switch (\Classes\User::delete($_GET['delete'])) {
        case 1: $deleteStatus = 'Benutzer entfernt'; break;
        case 2: $deleteStatus = 'Benutzer nicht gefunden'; break;
    }
}

$users = \Classes\User::getUsers();
?>

<html>
    <head>
        <title>pCMS ACP</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <script>
        function check(id, val) {
            $(function() {
                if (val == 1 || val == 2) return;
                document.getElementById('del').innerHTML = "<a href='?p=user&delete="+id+"' class='jbutton'>L&ouml;schen</a>";
                document.getElementById('dialog').style.display='block';
                $( "#dialog" ).dialog();
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
            <li class="current"><a href="?p=user">Benutzer</a></li>
            <li><a href="#">Medien</a></li>  
            <li><a href="#">Styles</a></li>
            <li><a href="#">Inhalte</a></li>
            <li><a href="#">Plugins</a></li>
            <li><a href="#">Referenzen</a></li>
            <li><a href="?p=logout">Logout</a></li>
        </ul>

        <div id="main">
            <div class="userlist">
                <div class="header">Registrierte Benutzer</div>
                <div class="info"><?=$deleteStatus?></div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Benutername</th>
                            <th>E-Mail</th>
                            <th>Aktion</th>
                        </tr>
                    </thead>
                    <tbody>               
                    <? for ($i=0;$i<count($users);$i++) { ?>
                    <form onchange="check(this)" name="<?=$users[$i]['name']?>" action="?p=user&a=opt&v=<?=$users[$i]['id']?>" method="post">
                        <tr>
                            <td><?=$users[$i]['id']?></td>
                            <td><?=$users[$i]['name']?></td>
                            <td><?=$users[$i]['email']?></td>
                            <td>
                                <select name="option" onchange="check(<?=$users[$i]['id']?>, this.value)">
                                    <option value="1">bitte w&auml;hlen</option>
                                    <option value="2">bearbeiten</option>
                                    <option value="3">l&ouml;schen</option>
                                </select>
                            </td>
                        </tr>
                        </form>
                    <? } ?>
                    </tbody>
                </table>
            </div>
            <div class="register">
                <div class="header">Benutzer anlegen</div>
                <div class="regInfo"><?=$registerStatus?></div>
                <form action="?p=user&a=register" method="post">
                    <input type="text" name="username" placeholder="Benutzername"><br>
                    <input type="text" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Passwort"><br>
                    <input type="password" name="password_wdh" placeholder="Passwort wiederholen"><br>
                    <input type="submit" name="register" value="Benutzer anlegen" class="button">
                </form>

                <div id="dialog" title="Benutzer l&ouml;schen" style="display:none;">
                    <br>Benutzer entfernen<br><br>
                    <p id="del"></p>
                </div>

            </div>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
