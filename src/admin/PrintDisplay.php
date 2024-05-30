<?php
/**
 *  PrintDisplay class
 *  Handles CRUD functionality 
 *  Create Read Update Delete
 *
 *  Php version 8
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

 namespace Yso\admin;

use Yso\database as database;

use PDO;
use Exception;
use PDOException;

// Code validation update:
// Disabling phpcs warning for private vars / methods with underscore
// phpcs:disable PEAR.NamingConventions.ValidFunctionName.PrivateNoUnderscore
// phpcs:disable PEAR.NamingConventions.ValidVariableName.PrivateNoUnderscore

/**
 *  PrintDisplay class
 *
 *  Php version 8
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

class PrintDisplay implements PrintDisplayInterface
{
    private $database;

    private $postData;

    /**
     * Constructor
     * 
     * @param object $database : the database connection object
     */
    public function __construct(
        database\PDOconnectInterface $database
    ) {
        // Insert the object property
        $this->database = $database;
    }

    /**
     * Set post data property
     * 
     * @param array $postContent : post content
     * 
     * @return string $var : sanitized var
     */
    public function setTempStorage1($postContent)
    {
        $this->postData = $postContent;
    }


    /**
     * Extract & sanitize the post variable
     * 
     * @param string $variable : post key
     * 
     * @return string $var     : sanitized var
     */
    private function getPost($variable)
    {
        $var = isset($this->postData[$variable]) ? $this->postData[$variable] : null;
        if ($var) {
            $var = htmlspecialchars(strip_tags(trim($var)), ENT_QUOTES);
            // $var = htmlentities(strip_tags(trim($var)));
        }
        return $var;
    }

    /**
     * Update the database
     * 
     * @param string $sql    : the sql string
     * @param array  $params : the parameters 
     * 
     * @return string $dbFeedback : feedback from the database
     */
    private function dbConnect($sql, $params)
    {
        // Get result & send feedback
        try {
            $dbFeedback = $this->database->dbConnect($sql, $params);
            // $dbFeedback = 'Success';
            if (empty($dbFeedback)) {
                return true;
            }
        } catch (\Exception $e) {
            $dbFeedback = $e->getMessage();
            // var_dump($dbFeedback);
                return false;
        }
        return $dbFeedback;
    }

    /**
     * Print form with cities 
     * 
     * @return string $form : filled in formS
     */
    public function printFormAdd()
    {   
        // Load cities from database
        $cities = $this->cities();
        $html = "
                <h1> Add new </h1>
                <div class='form'>
                        <form method='post' class='form1'>
                            <input type='hidden' id='add' 
                            name='add' value='add'> <br>
                            <label for='name'> The Name </label> <br>
                            <input type='text' id='name' name='name' value=''> <br>
                            <label for='firstname'> Firstname </label> <br>
                            <input type='text' id='firstname' 
                            name='firstname' value=''><br>
                            <label for='email'> The email </label> <br>
                            <input type='text' id='email' name='email' value=''><br>
                            <label for='street'> The street </label> <br>
                            <input type='text' id='street' 
                            name='street' value=''><br>
                            <label for='zipcode'> The zip code </label> <br>
                            <input type='text' id='zipcode' 
                            name='zipcode' value=''><br>
                            <label for='city'> The city </label> <br>
                            $cities <br>
                            <br>
                        <button type='submit' class='btn1' 
                        name='submit' value='submit'>Submit</button>
                    </form>
                </div> ";
                
        return html_entity_decode($html);
        
    }

    /**
     * Autofil form with previous values (for edit)
     * 
     * @param object $result : result object
     * 
     * @return string $form : filled in formS
     */
    private function printForm($result)
    { 

        $html = false;

        if (is_object($result)) {

            $html = "<div class='form'>
                    <form method='post' class='form1' action='edit'>
                    <input type='hidden' id='edit2' name='edit2' value='edit2'> <br>
                    <label for='name'> The Name $result->name</label> <br>
                    <input type='hidden' id='name' name='name' 
                    value='$result->name'> <br>
                    <label for='firstname'> Firstname </label> <br>
                    <input type='text' id='firstname' name='firstname' 
                    value='$result->firstname'><br>
                    <label for='email'> The email </label> <br>
                    <input type='text' id='email' name='email' 
                    value='$result->email'><br>
                    <label for='street'> The street </label> <br>
                    <input type='text' id='street' name='street' 
                    value='$result->street'><br>
                    <label for='zipcode'> The zip code </label> <br>
                    <input type='text' id='zipcode' name='zipcode' 
                    value='$result->zipcode'><br>
                    <label for='city'> The city </label> <br>
                    <input type='text' id='city' name='city' 
                    value='$result->city'><br>
                    <br>
                    <button type='submit' class='btn1' 
                    name='submit' value='submit'>Submit</button>
                    </form>
                    </div> ";
        }
        return html_entity_decode($html);
    }

    
    /**
     * Edit data step 1
     * 
     * Get the previous data of a user 
     * Autofill a form for the edit
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function edit()
    {    

        // Get the name variable
        $name = $this->getPost('name');

        // If no name, return false
        if (!$name) {
            return false;
        }

        // The SQL and params
        $sql = "SELECT * FROM TheUsers WHERE name = ?";
        $param = [$name];

        // Get the name results
        $result = $this->dbConnect($sql, $param);

        // Print & return the form 
        if (isset($result[0])) {
            return $this->printForm($result[0]);
        }

        if (!isset($result[0])) {
            return 'Not found';
        }
    }

    // /**
    //  * Edit data step 2
    //  * 
    //  * Update with the new user data
    //  * 
    //  * @return string $dbFeedback : feedback from the database
    //  */
    // public function edit2()
    // {    

    //     // Control the incoming parameters 
    //     $name = $this->getPost('name');
    //     $firstname = $this->getPost('firstname');
    //     $email = $this->getPost('email');
    //     $street = $this->getPost('street');
    //     $zipcode = $this->getPost('zipcode');
    //     $city = $this->getPost('city');

    //     // Create the query
    //     $sql = "UPDATE TheUsers SET firstname = ?, email = ?, 
    //     street = ?, zipcode = ?, city = ? WHERE name = ? ";

    //     $params = [$firstname, $email, $street, $zipcode, $city, $name];

    //     // Return the results
    //     $res = $this->dbConnect($sql, $params);

    //     if ($res) {
    //         $dbFeedback = 'Success';
    
    //     }

    //     if (!$res) {
    //         $dbFeedback = 'Some error - check for 
    //         duplicates / unregistered city / other error';
    //     }

    //     return $dbFeedback;

    // }

    /**
     * Print edit
     * 
     * @return string $form : filled in formS
     */
    public function printEditForm()
    {   
        $html = "
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
                
        return html_entity_decode($html);
    }

    /**
     * Print delete form
     * 
     * @return string $form : filled in formS
     */
    public function printDeleteForm()
    {   
        $html = "
                <h1> Delete </h1>
                <div class='form'>
                <form method='post' class='form1'>
                <input type='hidden' id='delete' name='delete' value='delete'> <br>
                <label for='name'> The Name </label> <br>
                <input type='text' id='name' name='name' value=''> <br>
                <button type='submit' class='btn1' 
                name='submit' value='submit'>Submit</button>
                </form>
                </div> ";
                
        return html_entity_decode($html);
    }

    // /**
    //  * Delete (soft)
    //  * 
    //  * SOFT DELETES from the database (marks as deleted)
    //  * 
    //  * @return string $dbFeedback : feedback from the database
    //  */
    // public function delete()
    // {    
    //     // Control the incoming parameters 
    //     $name = $this->getPost('name');

    //     // Create the query
    //     $sql = "UPDATE TheUsers SET deleted = ? WHERE name = ? ;";
    //     $params = [true, $name];

    //     // Return the results
    //     $res = $this->dbConnect($sql, $params);
    //     if ($res) {
    //         $dbFeedback = 'Deleted all found';
    //     }

    //     if (!$res) {
    //         $dbFeedback = 'Some error - check for duplicates 
    //         / unregistered city / other error';
    //     }

    //     return $dbFeedback;
    // }

    // /**
    //  * Delete (hard)
    //  * 
    //  * Removes it from the database
    //  * 
    //  * @return string $dbFeedback : feedback from the database
    //  */
    // public function hardDelete()
    // {    
    //     // Control the incoming parameters 
    //     $name = $this->getPost('name');

    //     // Create the query
    //     $sql = "DELETE FROM TheUsers WHERE name = ? ;";
    //     $params = [$name];

    //     // Return the results
    //     return $this->dbConnect($sql, $params);
    // }

    /**
     * Print the HTML table
     * Print html of the content
     * 
     * @param object $users : users for printing as object
     * 
     * @return string $table : prints html table of content
     */
    private function printTable($users)
    {
        $table = false;
        if (is_array($users)) {
            $table = "<table> 
                    <tr class='first'> 
                        <th> Name </th> 
                        <th> Firstname </th> 
                        <th> Email </th>
                        <th> Street </th>
                        <th> Zipcode </th>
                        <th> City </th>
                    </tr>";

            foreach ($users as $user) {
                $table .= "<tr><th> $user->name </th>
                        <th> $user->firstname </th>
                        <th> $user->email </th>
                        <th> $user->street </th>
                        <th> $user->zipcode </th>
                        <th> $user->city </th>
                        ";
                $table .= "</tr>";
                
            }
            $table .= "</table>";
            
        }
        return $table;
    }

    /**
     * Print XML syntax
     * 
     * @param object $users : users for printing as object
     * 
     * @return string $xml : prints xml of users
     */
    private function printXML($users)
    {
        $xml = false;
        if (is_array($users)) {
            $xml = "<addresses>";

            foreach ($users as $user) {

                $xml .= "
                        <address>
                            <name> $user->name </name>
                            <firstname> $user->firstname </firstname>
                            <email> $user->email </email>
                            <street> $user->street </street>
                            <zipcode> $user->zipcode </zipcode>
                            <city> $user->city </city>
                        </address>
                        ";
            }
            $xml .= "</addresses>";
        }
        return html_entity_decode($xml);
    }

    /**
     * Print JSON syntax
     * 
     * @param object $users : users for printing as object
     * 
     * @return string $json : prints json of users
     */
    private function printJSON($users)
    {
        $json = false;
        if (is_array($users)) {
            $json = '{"addresses":[';
            
            foreach ($users as $user) {
                $json .= '
                          {"name":"'. $user->name.'",
                           "firstname":"'. $user->firstname.'",
                           "email":"'. $user->email.'",
                           "street":"'. $user->street.'",
                           "zipcode":"'. $user->zipcode.'",
                           "city":"'. $user->city.'"},';
            }
            $json = rtrim($json, ',');
            $json .= "]}";
        }
        return html_entity_decode($json);
    }

    /**
     * List the users - deleted / not deleted
     * Print html of the content
     * 
     * @param boolean $listDeleted : list only deleted or not
     * @param boolean $xml         : print in xml
     * @param boolean $json        : print in json
     * 
     * @return string $table   : prints html table of content
     */
    public function list($listDeleted, $xml = null, $json = null)
    {    
        if (is_bool($listDeleted)) {

            // The sql 
            $sql = "SELECT * FROM TheUsers WHERE deleted = ?";
            $param=[$listDeleted];

            // Get the result object & print it 
            $result = $this->dbConnect($sql, $param);

            // Print & return the form 
            if (!$xml && !$json && $result) {
                return $this->printTable($result);
            }
            if ($xml && $result) {
                return $this->printXML($result);
            }
            if ($json && $result) {
                return $this->printJSON($result);
            }
        }
    }

    /**
     * Print lists of users & buttons for XML / JSON
     * 
     * @return string $list : return lists & content
     */
    public function printLists()
    {   
        $users = $this->list(false);
        $deleted = $this->list(true);

        // XML button 
        $xml = "<form action='xml' method ='post' target='_blank'>
        <input type='submit' class='btn2' value='XML'>
        </form>
        ";
        // JSON btn
        $json = "<form action='json' method ='post' target='_blank'>
        <input type='submit' class='btn2' value='JSON'>
        </form>
        ";

        $lists = "<div class='result'>

                <h1> Listed users </h1>
                $users <br>

                <h1> Print XML </h1>
                $xml <br>

                <h1> Print JSON </h1>
                $json <br>

                <h1> Deleted users </h1>
                $deleted
                </div> ";
        
        return $lists;
    }


    /**
     * Print the HTML drop down menu
     * 
     * @param object $cities : list the cities
     * 
     * @return string $menu : drop down menu to insert into a form
     */
    private function printMenu($cities)
    {
        $menu = false;
        if (is_array($cities)) {
            $menu = "<select id='city' name='city' size='1'>";

            foreach ($cities as $city) {
                $menu .= "<option value='$city->name'>
                         $city->name</option>";                
            }
            $menu .= "</select>";
        }
        return $menu;
    }


    /**
     * DropDownMenu cities - for form
     * 
     * @return string $menu   : prints html content
     */
    private function cities()
    {    
        // The sql 
        $sql = "SELECT name FROM TheCities";

        // Get the result object & print it 
        $result = $this->dbConnect($sql, null);

        // Print & return the form 
        if ($result) {
            return $this->printMenu($result);
        }
    }
}
