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

class Main {
    public static function start() {
        ScriptLoader::loadMySQLScripts();
        ScriptLoader::loadUserScripts();
        ScriptLoader::loadPageScripts();
        ScriptLoader::loadScriptsFromPlugins();

        $page = new Page('Default');
        $page->generate();
        echo $page->getContent();
    }
}

?>
