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

 namespace Lodur\Base;

// CONFIGURATION
// Require configuration 
require __DIR__ . "/config/config.php";

// Autoloading 
// - for enabling namespace & access to objectoriented functionality 
require __DIR__ . "/vendor/autoload.php";

// Print and echo XML
$usersXML = $admin->list(false, true);

header('Content-type: text/xml');

echo $usersXML;