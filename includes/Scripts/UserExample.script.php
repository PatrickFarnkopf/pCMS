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

class UserExample extends \Classes\Scripting\UserScript {
    function OnLogin(\Classes\User $user) {
        //Code wird beim Login ausgeführt
    }

    function OnLogout(\Classes\User $user) {
        //Code wird beim Logout ausgeführt
    }

    function OnRegister(\Classes\User $user, &$status) {
        //Code wird beim Registrieren ausgeführt
    }
}

?>
