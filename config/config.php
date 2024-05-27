<?php
/**
 *   Config file for php unit tests
 *   php version 7
 *
 * @category Test
 * @package  PhpBase
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

 
namespace Lodur\Base;

use Lodur\database as theDb;
use Lodur\admin as admin;


require __DIR__ . "/../vendor/autoload.php";

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

// On every $_POST, set the data to the object
if ($_POST) {
    $admin->setPost($_POST);
}

// Database feedback - displays in the html 
// var_dump($database);
if (!$database->setDb) {
    $dbFeedback = 'The database is NOT set';
}

if ($database->setDb) {
    $dbFeedback = 'The database is set';
}