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

$html = '';

$data = "
            <h1> Edit </h1>
            <div class='form'>
                    <form method='post' class='form1'>
                        <input type='hidden' id='edit' name='edit' value='edit'> <br>
                        <label for='name'> The Name </label> <br>
                        <input type='text' id='name' name='name' value=''> 
                        <br>
                    <button type='submit' class='btn1' 
                    name='submit' value='submit'>Submit</button>
                    </form>
            </div> ";

$html = '';


if (isset($_POST['edit'])) {

    $html = $admin->edit();

}

if (isset($_POST['edit2'])) {

    $res = $admin->edit2();

    if ($res) {
        $dbFeedback = 'Success';
        header('Location: list');
    }
    if (!$res) {
        $dbFeedback = 'Some error - check for 
        duplicates / unregistered city / other error';
    }
}

$data = "<div class='result'>
            $data
            $html
        </div> ";

