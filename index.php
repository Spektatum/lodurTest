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
 *
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

//$actual_link = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// var_dump($actual_link);

// Refresh if needed
// echo 'test';
// $_SESSION['reloadList'] = 'test';
// var_dump($_SESSION['reloadList']);
// header("Location:$actual_link");

// if (isset($_SESSION['reload'])) {
// //     var_dump($_SESSION['reload']);
// //     echo 'set list';

//     unset($_SESSION['reload']);
// //     header("Location:$actual_link");
//     header('Location: listAll');
// }

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

include 'view/'.$view;