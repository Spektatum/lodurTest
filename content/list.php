<?php
/**
 *   Content
 *   php version 8
 *   Content file
 *
 * @category Content
 * @package  Lodur
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT 
 * @link     https://www.spektatum.com
 **/

// List all content

namespace Yso\Base;

use Yso\database as theDb;

// List the 
$users = $admin->list(false);
$deleted = $admin->list(true);

// XML button 
$xml = "<form action='xml.php' method ='post' target='_blank'>
            <input type='submit' class='btn2' value='XML'>
        </form>
        ";
// JSON btn
$json = "<form action='json.php' method ='post' target='_blank'>
            <input type='submit' class='btn2' value='JSON'>
        </form>
        ";

$list = "<div class='result'>
            
            <h1> Listed users </h1>
            $users <br>

            <h1> Print XML </h1>
            $xml <br>

            <h1> Print JSON </h1>
            $json <br>

            <h1> Deleted users </h1>
            $deleted
        </div> ";