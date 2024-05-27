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
define('NAMESPACE1', 'Lodur');

// AUTOLOADING
// - for enabling namespace & access to objectoriented functionality 
require __DIR__ . "/autoloader/autoloader.php";

// CONFIGURATION
// Require configuration 
require __DIR__ . "/config/config.php";

// Include the content 
include "content/delete.php";

// Include the version
$version = 'LodurTest1';

// Include the view 
include 'view/viewBase1.php'; 


