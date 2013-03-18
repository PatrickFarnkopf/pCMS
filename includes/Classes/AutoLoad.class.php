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

namespace Classes\Main;
class AutoLoad {
    /**
     * Erstellt aus dem übergebenen Namespace den Verzeichnispfad
     * @param String namespace_
     * @return String path
     */
    public static function getFilePath($namespace_) {
        if (empty($namespace_))
            throw new \Exception('Variable $namespace_ ist leer! (AutoLoad::getFilePath(String))');
        if (strstr($namespace_, 'Config'))
            return './includes/'.str_replace('\\','/',$namespace_).'.conf.php';
        if (strstr($namespace_, 'Classes'))
            return './includes/'.str_replace('\\','/',$namespace_).'.class.php';
        return false;
    }
}