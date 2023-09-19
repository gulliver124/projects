<?php
    defined('DS') ? null :define('DS',DIRECTORY_SEPARATOR);
    defined('PATH_TO_DBCON')? NULL:define('PATH_TO_DBCON',$_SERVER['DOCUMENT_ROOT'].DS.'smartms'.DS.'includes'.DS.'confile.php');
    
    defined('PATH_TO_SESSION')?null : define('PATH_TO_SESSION',$_SERVER['DOCUMENT_ROOT'].DS.'smartms'.DS.'includes'.DS.'session.php');
    defined('PATH_TO_NOTIFY')?null : define('PATH_TO_NOTIFY',$_SERVER['DOCUMENT_ROOT'].DS.'smartms'.DS.'includes'.DS.'notify.php');
    
    defined('PATH_TO_ACCESS')?null : define('PATH_TO_ACCESS',$_SERVER['DOCUMENT_ROOT'].DS.'smartms'.DS.'includes'.DS.'access.php');
    defined('PATH_TO_HELPERS')?null : define('PATH_TO_HELPERS',$_SERVER['DOCUMENT_ROOT'].DS.'smartms'.DS.'includes'.DS.'helpers.php');
?>