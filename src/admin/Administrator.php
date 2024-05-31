<?php
/**
 *  Administration class
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
 *  Administration class
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

        if (!$name) {
            return false;
        }

        $sql = "INSERT INTO TheUsers 
        (name, firstname, email, street, zipcode, city) VALUES (?, ?, ?, ?, ?, ?)";

        $params = [$name, $firstname, $email, $street, $zipcode, $city];

        // Get result & send feedback
        $result = $this->dbConnect($sql, $params);
        // Feedback
        if ($result) {
            $dbFeedback = '<div class="feedback2">
                                Success
                            </div>';
        }

        if (!$result) {
            $dbFeedback = '<div class="feedback2">
                                Some error - check for 
                                duplicates / unregistered city / other error
                           </div>';
        }
        return $dbFeedback;
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
        $res = $this->dbConnect($sql, $params);

        if ($res) {
            $dbFeedback = '<div class="feedback2">
                              Success
                           </div>';
    
        }

        if (!$res) {
            $dbFeedback = ' <div class="feedback2"> 
                                Some error - check for 
                                duplicates / unregistered city / other error
                            </div>';
        }

        return $dbFeedback;

    }


    /**
     * Delete (soft)
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
        $res = $this->dbConnect($sql, $params);
        if ($res) {
            $dbFeedback = ' <div class="feedback2"> 
                                Deleted all found, if found.
                            </div>';
        }

        if (!$res) {
            $dbFeedback = '<div class="feedback2"> 
                                Some error - check for duplicates 
                                 / unregistered city / other error
                           </div>';
        }

        return $dbFeedback;
    }


    /**
     * Delete (hard)
     * 
     * Removes it from the database
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function hardDelete()
    {    
        // Control the incoming parameters 
        $name = $this->getPost('name');

        // Create the query
        $sql = "DELETE FROM TheUsers WHERE name = ? ;";
        $params = [$name];

        // Return the results
        return $this->dbConnect($sql, $params);
    }

}
