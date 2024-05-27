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

 namespace Yso\Base;

 use Yso\database as theDb;

 // Get a drop down menu 
 $menu = $admin->cities();

 $dbFeedback = '';

 $data = "
        <h1> Add new </h1>
        <div class='form'>
                <form method='post' class='form1'>
                    <input type='hidden' id='add' name='add' value='add'> <br>
                    <label for='name'> The Name </label> <br>
                    <input type='text' id='name' name='name' value=''> <br>
                    <label for='firstname'> Firstname </label> <br>
                    <input type='text' id='firstname' name='firstname' value=''><br>
                    <label for='email'> The email </label> <br>
                    <input type='text' id='email' name='email' value=''><br>
                    <label for='street'> The street </label> <br>
                    <input type='text' id='street' name='street' value=''><br>
                    <label for='zipcode'> The zip code </label> <br>
                    <input type='text' id='zipcode' name='zipcode' value=''><br>
                    <label for='city'> The city </label> <br>
                    $menu<br>
                    <br>
                <button type='submit' class='btn1' 
                name='submit' value='submit'>Submit</button>
            </form>
        </div> ";

if (isset($_POST['add'])) {

    $res = $admin->add();

    if ($res) {
        $dbFeedback = 'Success';
        header('Location: list');

    }
    if (!$res) {
        $dbFeedback = 'Some error - check for 
        duplicates / unregistered city / other error';
    }
}