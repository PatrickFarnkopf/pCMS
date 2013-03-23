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

require_once '../includes/Classes/AutoLoad.class.php';

function __autoload($name) {
    require_once '.'.\Classes\Main\AutoLoad::getFilePath($name);
}

function exceptionHandler($exception) {
    \Classes\ExceptionHandler::handleException($exception);
}

function exceptionErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new \ErrorException($errstr, 0x02, $errno, $errfile, $errline);
}

set_error_handler('exceptionErrorHandler');
set_exception_handler('exceptionHandler');

if (isset($_GET['p'])) {
	switch ($_GET['p']) {
		case 'login': 	require_once 'pages/login.inc.php'; break;
		case 'main':    require_once 'pages/main.inc.php'; break;
        case 'media':   require_once 'pages/media.inc.php'; break;
		case 'user': 	require_once 'pages/user.inc.php'; break;
        case 'logout': 
            $_SESSION = []; 
            header("Refresh: 5; ?p=login"); 
            echo "Sie werden in 5 Sekunden in den Login-Bereich weitergeleitet.";  
            break;
	}
} else {
	header('Location: ?p=login');
}

?>
