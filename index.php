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


// Autoloading 
// - for enabling namespace & access to objectoriented functionality 
require __DIR__ . "/vendor/autoload.php";

// Include the navigation
include "content/nav.php";

// Include the content for adding
include "content/add.php";

// Include the version
$version = 'LodurTest1';

// Include the view 
include 'view/viewBase1.php'; 


