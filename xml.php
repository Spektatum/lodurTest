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

// Print and echo XML
$usersXML = $admin->list(false, true);

header('Content-type: text/xml');

 echo '<?xml version="1.0" encoding="UTF-8"?>'; 

echo $usersXML;