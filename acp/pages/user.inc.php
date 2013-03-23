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

    if ($_GET['a'] === 'edit') {
        $user = new \Classes\User($_POST['id']);
        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        
        if (isset($_POST['password']) && isset($_POST['password_wdh'])) {
            $pass = trim($_POST['password']);
            if (!empty($pass)) {
                if ($_POST['password'] == $_POST['password_wdh']) {
                    $user->setPassword($pass);
                }
            }
        }

        $user->saveToDB();
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
        function check(id, name, email, val) {
            $(function() {
                if (val == 1) return;
                if (val == 2) {
                    document.getElementById('id').value = id;
                    document.getElementById('user').value = name;
                    document.getElementById('email').value = email;
                    document.getElementById('pass').value = '          ';
                    document.getElementById('passwdh').value = '          ';
                    document.getElementById('editUserDialog').style.display='block';
                    $( "#editUserDialog" ).dialog();  
                } else {
                    document.getElementById('del').innerHTML = "<a href='?p=user&delete="+id+"' class='jbutton'>L&ouml;schen</a>";
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
            <li class="current"><a href="?p=user">Benutzer</a></li>
            <li><a href="?p=media">Medien</a></li>  
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
                    <form name="<?=$users[$i]['name']?>" action="?p=user&a=opt&v=<?=$users[$i]['id']?>" method="post">
                        <tr>
                            <td><?=$users[$i]['id']?></td>
                            <td><?=$users[$i]['name']?></td>
                            <td><?=$users[$i]['email']?></td>
                            <td>
                                <select name="option" onchange="check(<?=$users[$i]['id']?>, '<?=$users[$i]['name']?>', '<?=$users[$i]['email']?>', this.value)">
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
                    <input type="text" name="username" placeholder="Benutzername" autocomplete='off'><br>
                    <input type="text" name="email" placeholder="Email" autocomplete='off'><br>
                    <input type="password" name="password" placeholder="Passwort" autocomplete='off'><br>
                    <input type="password" name="password_wdh" placeholder="Passwort wiederholen" autocomplete='off'><br>
                    <input type="submit" name="register" value="Benutzer anlegen" class="button">
                </form>

                <div id="deleteDialog" title="Benutzer l&ouml;schen" style="display:none;">
                    <br>Benutzer entfernen<br><br>
                    <p id="del"></p>
                </div>

                <div id="editUserDialog" title="Benutzer bearbeiten" style="display:none;">
                    <form action="?p=user&a=edit" method="post">
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="username" placeholder="Benutzername" id="user" autocomplete='off'><br>
                        <input type="text" name="email" placeholder="Email" id="email" autocomplete='off'><br>
                        <input type="password" name="password" placeholder="Passwort" id="pass" autocomplete='off'><br>
                        <input type="password" name="password_wdh" placeholder="Passwort wiederholen" id="passwdh" autocomplete='off'><br>
                        <input type="submit" name="register" value="Benutzer &auml;ndern" class="button">
                    </form>
                </div>

            </div>
        </div>

        <div id="footer">
            &copy; Patrick Farnkopf
        </div>
    </body>
</html>
