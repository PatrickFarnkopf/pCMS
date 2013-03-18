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

class Scripting extends Singleton {
    private static $script = [];
    private static $content = [];

    public static function registerScript($scriptName) {
        self::$script[] = $scriptName;
    }

    public static function loadFunctions() {
        if (count(self::$script)) {
            for ($i=0;$i<self::$script;++$i) {
                $file = fopen('includes/Scripts/'.self::$script[$i], 'rb');
                while (($buff = fgets($file, 4096)) !== false) {
                    //Zerlege Script in die einzelnen Funktionen
                    //und speichere sie entsprechend ab
                }
            }
        }
    }

    //MySQL Scripts
    public static function _OnMySQLConnect() {
        eval(self::$content['MySQL']['OnConnect']);
    }

    public static function _OnMySQLClose() {
        eval(self::$content['MySQL']['OnClose']);
    }

    public static function _OnQueryExecute(&$sql) {
        eval(self::$content['MySQL']['OnConnect']);
    }


    //Loader Scripts
    public static function _OnLoaderLoad() {
        eval(self::$content['Loader']['OnLoad']);
    }


    //User Scripts
    public static function _OnUserLogin($userObj) {
        eval(self::$content['User']['OnLogin']);
    }

    public static function _OnUserLogout($userObj) {
        eval(self::$content['User']['OnLogout']);
    }
}

?>
