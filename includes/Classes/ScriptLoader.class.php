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

namespace Classes;

class ScriptLoader {
    public static $mysqlScripts = [];
    public static $userScripts = [];
    public static $pageScripts = [];
    
    public static function loadMySQLScripts() {
        self::$mysqlScripts = 
        [
            //Hier die MySQL Scripts registrieren
            new \Scripts\MySQLExample(),
        ];
    }

    public static function loadUserScripts() {
        self::$userScripts = 
        [
            //Hier die User Scripts registrieren
            new \Scripts\UserExample(),
        ];
    }

    public static function loadPageScripts() {
        self::$pageScripts =
        [
            //Hier die Page Scripts registrieren
            new \Scripts\PageExample(),
        ];
    }
}

?>
