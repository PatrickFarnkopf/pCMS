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

class PageScript extends \Classes\Singleton {

    function OnGenerate(\Classes\User $user) { }

    public function _OnGenerate(&$template) {
        foreach (\Classes\ScriptLoader::$pageScripts as $script) {
            $script->OnGenerate($template);
        }
    }
}

?>
