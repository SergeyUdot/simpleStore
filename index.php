<?php

// Front Controller

// options
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// include some needed files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');

// call router
$router = new Router();
$router->run();








?>