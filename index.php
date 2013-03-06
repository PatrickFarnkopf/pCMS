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

session_start();

function __autoload($name) {
    if (file_exists('includes/'.$name.'.class.php'))
        require_once 'includes/'.$name.'.class.php';
    else 
        throw new \Exception('Beim Laden der Klasse '.$name.' ist ein Fehler aufgetreten. 
                             Datei ./includes/'.$name.'.class.php existiert nicht!', 0x01);
}

function exceptionHandler($exception) {
    \Classes\ExceptionHandler::handleException($exception);
}

function exceptionErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new \ErrorException($errstr, 0x02, $errno, $errfile, $errline);
}

set_error_handler('exceptionErrorHandler');
set_exception_handler('exceptionHandler');

new \Classes\Main();

?>
