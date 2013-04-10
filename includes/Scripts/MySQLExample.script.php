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

class MySQLExample extends \Classes\Scripting\MySQLScript {
    function OnConnect() {
        //echo 'Ich bin ein Script und werde beim Verbinden ausgef&uuml;hrt!';
        //exit;
    }

    function OnClose() {
        //echo 'Ich bin ein Script und werde beim beenden der Verbindung ausgef&uuml;hrt!';
    }

    function OnQueryExecute(&$sql) {
        echo $sql.'<br>';
    }
}

?>
