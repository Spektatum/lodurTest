<?php
/**
 *  Sample controller
 *
 *  Php version 8
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

 namespace Lodur\admin;

use Lodur\database as database;

use PDO;
use Exception;
use PDOException;

 // Disabling phpcs warning for private vars / methods with underscore
 // phpcs:disable PEAR.NamingConventions.ValidFunctionName.PrivateNoUnderscore
 // phpcs:disable PEAR.NamingConventions.ValidVariableName.PrivateNoUnderscore

/**
 *  Sample
 *  php version 8
 *  The button controller
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

class Administrator implements AdminInterface
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
    public function setPost($postContent)
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
            $var = htmlentities(strip_tags(trim($var)));
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
            var_dump($dbFeedback);
                return false;
        }
        return $dbFeedback;
    }

    /**
     * Add to the database
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function add()
    {
        // Control the incoming parameters 
        $name = $this->getPost('name');
        $firstname = $this->getPost('firstname');
        $email = $this->getPost('email');
        $street = $this->getPost('street');
        $zipcode = $this->getPost('zipcode');
        $city = $this->getPost('city');

        $sql = "INSERT INTO TheUsers 
        (name, firstname, email, street, zipcode, city) VALUES (?, ?, ?, ?, ?, ?)";

        $params = [$name, $firstname, $email, $street, $zipcode, $city];

        // Get result & send feedback
        return $this->dbConnect($sql, $params);
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
                    <form method='post' class='form1' action='edit.php'>
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
        return $html;
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
    }

    /**
     * Edit data step 2
     * 
     * Update with the new user data
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function edit2()
    {    

        // Control the incoming parameters 
        $name = $this->getPost('name');
        $firstname = $this->getPost('firstname');
        $email = $this->getPost('email');
        $street = $this->getPost('street');
        $zipcode = $this->getPost('zipcode');
        $city = $this->getPost('city');

        // Create the query
        $sql = "UPDATE TheUsers SET firstname = ?, email = ?, 
        street = ?, zipcode = ?, city = ? WHERE name = ? ";

        $params = [$firstname, $email, $street, $zipcode, $city, $name];

        // Return the results
        return $this->dbConnect($sql, $params);

    }

    /**
     * Delete 
     * 
     * SOFT DELETES from the database (marks as deleted)
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function delete()
    {    
        // Control the incoming parameters 
        $name = $this->getPost('name');

        // Create the query
        $sql = "UPDATE TheUsers SET deleted = ? WHERE name = ? ;";
        $params = [true, $name];

        // Return the results
        return $this->dbConnect($sql, $params);

    }

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
            $xml = "<users>";

            foreach ($users as $user) {
                $xml .= "
                        <user>
                            <name> $user->name </name>
                            <firstname> $user->firstname </firstname>
                            <email> $user->email </email>
                            <street> $user->street </street>
                            <zipcode> $user->zipcode </zipcode>
                            <city> $user->city </city>
                        </user>
                        ";
            }
            $xml .= "</users>";
        }
        return $xml;
    }

    /**
     * List the users
     * Print html of the content
     * 
     * @param boolean $listDeleted : list only deleted or not
     * 
     * @return string $table   : prints html table of content
     */
    public function list($listDeleted, $xml = null)
    {    
        if (is_bool($listDeleted)) {

            // The sql 
            $sql = "SELECT * FROM TheUsers WHERE deleted = ?";
            $param=[$listDeleted];

            // Get the result object & print it 
            $result = $this->dbConnect($sql, $param);

            // Print & return the form 
            if (!$xml && $result) {
                return $this->printTable($result);
            }
            if ($xml && $result) {
                return $this->printXML($result);
            }
        }
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
    public function cities()
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
