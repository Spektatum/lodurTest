<?php
/**
 *   Config file 
 *   php version 7
 *
 * @category Configuration
 * @package  Lodur
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

namespace Yso\Base;

use Yso\database as theDb;
use Yso\admin as admin;
use Yso\router as router;

// AUTOLOADING
// - for enabling namespace & access to objectoriented functionality 
require __DIR__ . "/../autoloader/autoloader.php";

// Error handling
ini_set("display_errors", 1);     
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// DATABASE CONNECTION
// Set host and database
$host = '127.0.0.1';
$theDb = 'theLodurTest';

// Username and password for the database
$user = 'user';
$pass = 'pass';

// Database object
$database = new theDb\PDOconnect($host, $theDb, $user, $pass); // Basic db connection

// Admin object
$admin = new admin\Administrator($database);

// Router object
$router = new router\Router($database, $admin, $_POST);

// On every $_POST, set the data to the object
if ($_POST) {
    $admin->setTempStorage1($_POST);
    $router->setTempStorage1($_POST);
}

if ($_GET) {
    $router->setTempStorage2($_GET);
}

// Database feedback - displays in the html 
// var_dump($database);
if (!$database->setDb) {
    $dbFeedback = 'The database is NOT set';
}

if ($database->setDb) {
    $dbFeedback = 'The database is set';
}