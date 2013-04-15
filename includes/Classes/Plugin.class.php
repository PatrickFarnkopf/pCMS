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

class Plugin extends Singleton {
    public static function install($file) {
        $archiv = new Tar($file);
        $data = $archiv->getContentArray();
        $ini = false;

        foreach ($data as $key => $value) {
            if (strpos($key, 'install.ini') !== false)
                $ini = parse_ini_string($value);
            if (strpos($key, '.script.php') !== false)
                $script[$key] = $value;
        }

        if (!$ini) 
            return false;

        if (isset($ini['scripts'])) {
            foreach ($ini['scripts'] as $value) {
                touch('../includes/Scripts/'.$value);
                file_put_contents('../includes/Scripts/'.$value, $scritp[$value]);
            }
        }


    }
}

?>
