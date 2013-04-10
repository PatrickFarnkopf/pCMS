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

class UserScript extends \Classes\Singleton {

    function OnLogin(\Classes\User $user) { }
    function OnLogout(\Classes\User $user) { }
    function OnRegister(\Classes\User $user, &$status) { }

    public function _OnLogin(\Classes\User $user) {
        foreach (\Classes\ScriptLoader::$userScripts as $script) {
            $script->OnLogin($user);
        }
    }

    public function _OnLogout(\Classes\User $user) {
        foreach (\Classes\ScriptLoader::$userScripts as $script) {
            $script->OnLogout($user);
        }
    }

    public function _OnRegister(\Classes\User $user, &$status) {
        foreach (\Classes\ScriptLoader::$userScripts as $script) {
            $script->OnRegister($user, $status);
        }
    }
}

?>
