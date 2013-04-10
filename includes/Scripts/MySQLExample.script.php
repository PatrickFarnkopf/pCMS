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
        //Wird beim Verbinden mit dem MySQL Server aufgerufen
    }

    function OnClose() {
        //Wird beim Trennen der MySQL Server Verbindung aufgerufen
    }

    function OnQueryExecute(&$sql) {
        //Wird aufgerufen bevor ein Query durchgeführt wird.
    }
}

?>
