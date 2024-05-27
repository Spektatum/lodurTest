<?php
/**
 *   Delete
 *   php version 8
 *   Content file
 *
 * @category Content
 * @package  Lodur
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT 
 * @link     https://www.spektatum.com
 **/

 namespace Lodur\Base;

 use Lodur\database as theDb;

 $data = "<div class='form'>
          <form method='post' class='form1'>
            <input type='hidden' id='delete' name='delete' value='delete'> <br>
            <label for='name'> The Name </label> <br>
            <input type='text' id='name' name='name' value=''> <br>
          <button type='submit' class='btn1' 
          name='submit' value='submit'>Submit</button>
          </form>
          </div> ";

if (isset($_POST['delete'])) {

    $res = $admin->delete();

    if ($res) {
        $dbFeedback = 'Deleted all found';
    }
    if (!$res) {
        $dbFeedback = 'Some error - check for duplicates 
        / unregistered city / other error';
    }
}