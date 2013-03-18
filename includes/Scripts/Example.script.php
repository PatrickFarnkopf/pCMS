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

namespace Scripts;

script MySQLExample : MySQLScript {
    function OnConnect() {
        echo 'Ich bin ein Script und werde beim Verbinden ausgef&uuml;hrt!';
    }

    function OnClose() {
        echo 'Ich bin ein Script und werde beim beenden der Verbindung ausgef&uuml;hrt!';
    }

    function OnQueryExecute(&$sql) {
        //Hier kann der Query manipuliert werden
    }
}

script LoadingExample : LoaderScript {
    function OnLoad($pageName) {
        if ($pageName === 'login') {
            echo 'Hier ein zus&auml;tzlicher Text beim Login.';
        }
    }
}

script UserExample : UserScript {
    function OnLogin($userObj) {
        //User Action
    }

    function OnLogout($userObj) {
        //User Action
    }
}

?>
