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

namespace Classes\Scripting;

class MySQLScript extends \Classes\Singleton {
    
    function OnConnect() { }
    function OnClose() { }
    function OnQueryExecute(&$sql) { }

    public function _OnConnect() {
        foreach (\Classes\ScriptLoader::$mysqlScripts as $script) {
            $script->OnConnect();
        }
    }

    public function _OnClose() {
        foreach (\Classes\ScriptLoader::$mysqlScripts as $script) {
            $script->OnClose();
        }
    }

    public function _OnQueryExecute(&$sql) {
        foreach (\Classes\ScriptLoader::$mysqlScripts as $script) {
            $script->OnQueryExecute($sql);
        }
    }
}

?>
