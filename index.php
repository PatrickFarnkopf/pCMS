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

require_once 'includes/Classes/AutoLoad.class.php';

function __autoload($name) {
    require_once \Classes\Main\AutoLoad::getFilePath($name);
}

function exceptionHandler($exception) {
    \Classes\ExceptionHandler::handleException($exception);
}

function exceptionErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new \ErrorException($errstr, 0x02, $errno, $errfile, $errline);
}

set_error_handler('exceptionErrorHandler');
set_exception_handler('exceptionHandler');

\Classes\Singleton::setRootDir(__DIR__);

\Classes\Main::start();

?>
