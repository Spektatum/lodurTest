<?php
/**
 *   Index file
 *   php version 8
 *
 * @category Content
 * @package  Lodur
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT 
 * @link     https://www.spektatum.com 
 **/

 namespace Yso\Base;
 define('NAMESPACE1', 'Yso');

 // AUTOLOADING
 // - for enabling namespace & access to objectoriented functionality 
 require __DIR__ . "/autoloader/autoloader.php";

// CONFIGURATION
// Require configuration 
require __DIR__ . "/config/config.php";

// DATA
// Get the content from the router
// $data = $router->read('add');
$data = $router->getRoute('route');

// Check route
$thisRoute = $router->checkRoute('route');

if (isset($router->memory['reload'])) {
    unset($router->memory['reload']);
    header('Location: listAll');
}

// Include the version
$version = 'Lodur Test Sample 1.2';

// VIEW
// Include the view
$view = "viewBase1.php";

// Set the special view, if any
if ($thisRoute == 'xml') {
    $view = 'xml.php';
}

if ($thisRoute == 'json') {
    $view = 'json.php';
}

require 'view/'.$view;