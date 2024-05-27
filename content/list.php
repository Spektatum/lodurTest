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

namespace Lodur\Base;

use Lodur\database as theDb;

// List the 
$users = $admin->list(false);
$deleted = $admin->list(true);


$data = "<div class='result'>
            <h1> Listed users </h1>
            $users 

            <h2> Deleted users </h2>
            $deleted
        </div> ";