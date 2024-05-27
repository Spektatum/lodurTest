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

 use Lodur\database as theDb;
 use Lodur\admin as admin;

 define('NAMESPACE1', 'Lodur');

// Autoloading 
// - for enabling namespace & access to objectoriented functionality 
//require __DIR__ . "/vendor/autoload.php";

require __DIR__ . "/autoloader/autoloader.php";

// Database object
$database = new theDb\PDOconnect(null, null, null, null); // Basic db connection

// $database = new \Lodur\database\pdoConnect($host, $theDb, $user, $pass); // Basic db connection

//$admin = new \Lodur\admin\Administrator($database);

$admin = new admin\Administrator($database);


// Admin object
$admin = new admin\Administrator($database);


// Include the navigation
//include "content/nav.php";

// Include the content for adding
// include "content/add.php";

// Include the version
//


