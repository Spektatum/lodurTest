<?php
/**
 *  Router
 *
 *  Php version 8
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/


namespace Yso\router;

use Yso\database as database;
use Yso\admin as admin;

use PDO;
use Exception;

// Code validation update:
// Disabling phpcs warning for private vars / methods with underscore
// phpcs:disable PEAR.NamingConventions.ValidFunctionName.PrivateNoUnderscore
// phpcs:disable PEAR.NamingConventions.ValidVariableName.PrivateNoUnderscore

/**
 *  Router
 *
 *  Php version 8
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

Class Router implements RouterInterface
{
    private $database;      // The database object 
    private $administrator; // The administrator object
    private $storageTemp;   // The stored data (from form / $_POST)
    private $storageTemp2;  // The stored data (from form / $_GET)
    private $staticContent; // An array with static content

    /**
     * Constructor
     * 
     * @param object $database : the database object
     * @param object $admin    : the admin object
     * @param object $post     : the $_POST data (form / AJAX messages)
     * @param array  $content  : the static content
     */
    public function __construct(
        database\PDOconnectInterface $database,
        admin\AdminInterface $admin,
        array $post,
        array $content = [],
    ) {
        // Insert the object properties
        $this->database = $database;
        $this->administrator = $admin;
        $this->storageTemp = $this->sanitize($post);
        $this->staticContent = $content;
    }
        
    /**
     * Temporal storage
     * Set temporal storage (post data)
     * 
     * @param array $postContent : post content
     * 
     * @return string $var : sanitized var
     */
    public function setTempStorage1($postContent)
    {
        $this->storageTemp = $this->sanitize($postContent);
    }

    /**
     * Temporal storage 2
     * Set temporal storate (get data)
     * 
     * @param array $getContent : post content
     * 
     * @return string $var : sanitized var
     */
    public function setTempStorage2($getContent)
    {   
        $this->storageTemp2 = $this->sanitize($getContent);
    }

    /**
     * Sanitize content
     * Sanitize the content in an array
     * strip for tags & html
     * 
     * @param array $contentArr : array with content
     * 
     * @return array $contentArr : sanitized array
     */
    public function sanitize($contentArr)
    {   
        $sanitizedArr = [];
        if (is_array($contentArr)) {

            foreach ($contentArr as $key => $value) {
                $value = htmlentities(strip_tags(trim($value)));
                $key = htmlentities(strip_tags(trim($key)));
                $sanitizedArr += [$key=>$value];
            }    

        }
        return $sanitizedArr;
    }

    /**
     * Read route
     * 
     * @param string $route : the route for data return
     * 
     * @return mixed $data : returns the data
     */
    public function read(
        $route
    ) {

        // The Switch case
        switch ($route) {

        case "add":

            // Check storageTemp for data
            if (isset($this->storageTemp['add'])) {

                return $this->administrator->add();

            };

            // Form data
            return $this->administrator->printFormAdd();
            
            break;
            
        
        case "edit":

            // Check storageTemp for data
            if (isset($this->storageTemp['edit'])) {

                return $this->administrator->edit();

            };

            if (isset($this->storageTemp['edit2'])) {

                return $this->administrator->edit2();

            };

            // Form data
            return $this->administrator->printEditForm();
            
            break;

        
        case "delete":

            // Check storageTemp for data
            if (isset($this->storageTemp['delete'])) {

                return $this->administrator->delete();

            };

            // Form data
            return $this->administrator->printDeleteForm();
            
            break;

        
        case "lists":

            // List results
            return $this->administrator->printLists();
            
            break;

        default:

            // List results
            return $this->administrator->printLists();
    
            break;
        
        }
    }

    /**
     * Get route
     * Calls the read method with a route
     * and returns the route data
     * so 'list' returns the lists from the database
     * 
     * @param string $route : the route for data return
     * 
     * @return mixed $data : returns the data
     */
    public function getRoute($route)
    {
        if ($this->storageTemp2) {

            if (isset($this->storageTemp2[$route])) {
                return $this->read($this->storageTemp2[$route]);
            }

            if (!isset($this->storageTemp2[$route])) {
                return false;
            }
        }
        return false;
    }
}
