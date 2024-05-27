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

// Include the navigation
include "content/nav.php";

// Include the content 
include "content/edit.php";

// Include the version
$version = 'LodurTest1';

// Include the view 
include 'view/viewBase1.php'; 

