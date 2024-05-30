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

// Get the content from the router
$data = $router->read('edit');

// Include the version
$version = 'Lodur Test Sample';

// Include the view 
include 'view/viewBase1.php'; 


