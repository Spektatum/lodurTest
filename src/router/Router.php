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
    private $printDisplay;  // The administrator object
    public  $storageTemp;   // The stored data (from form / $_POST)
    private $storageTemp2;  // The stored data (from form / $_GET)
    public  $memory;        // The $_SESSION data

    /**
     * Constructor
     * 
     * @param object $database : the database object
     * @param object $admin    : the admin object
     * @param object $print    : the print display object
     * @param object $post     : the $_POST data (form / AJAX messages)
     * @param object $session  : the $_SESSION data (form / AJAX messages)
     */
    public function __construct(
        database\PDOconnectInterface $database,
        admin\AdminInterface $admin,
        admin\PrintDisplay $print,
        array $post,
        array $session = null
    ) {
        // Insert the object properties
        $this->database = $database;
        $this->administrator = $admin;
        $this->printDisplay = $print;
        $this->storageTemp = $this->sanitize($post);
        $this->memory = [$session];
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
            return $this->printDisplay->printFormAdd();
            
            break;
            
        
        case "edit":

            // Check storageTemp for data
            if (isset($this->storageTemp['edit'])) {

                return $this->printDisplay->edit();

            };

            // Update the database
            if (isset($this->storageTemp['edit2'])) {

                return $this->administrator->edit2();

            };

            // Form data
            return $this->printDisplay->printEditForm();
            
            break;

        
        case "delete":

            // Check storageTemp for data
            if (isset($this->storageTemp['delete'])) {

                return $this->administrator->delete();

            };

            // Form data
            return $this->printDisplay->printDeleteForm();
            
            break;

        
        case "list":

            // List results
            // Mark that the website should be reloaded
            $this->memory['reload'] = true;

            return $this->printDisplay->printLists();
            
            break;


        case "xml":

            // List results
            return $this->printDisplay->list(false, true);
            
            break;


        case "json":

            // List results
            return $this->printDisplay->list(false, false, true);
            
            break;


        default:

            // List results
            return $this->printDisplay->printLists();
    
            break;
        
        }
    }

    /**
     * Get route
     * Get the data for the current active route.
     * Gets the data from the router.
     * So route 'list' returns the lists from the database.
     * 
     * @param string $route : the route for data return
     * 
     * @return mixed $data : returns the data
     */
    public function getRoute($route)
    {   
        if ($this->storageTemp2) {

            if (isset($this->storageTemp2[$route])) {
                $routeVal = $this->storageTemp2[$route];
                return $this->read($routeVal);
            }

            if (!isset($this->storageTemp2[$route])) {
                return false;
            }
        }
        // If no route, set default
        return $this->read('');
    }

    /**
     * Check route
     * See what is set in the temporal storage ($_GET)
     * 
     * @param string $route : the route for data return
     * 
     * @return mixed $data : returns the data
     */
    public function checkRoute($route)
    {   
        if ($this->storageTemp2) {

            if (isset($this->storageTemp2[$route])) {
                return $this->storageTemp2[$route];
            }

            if (!isset($this->storageTemp2[$route])) {
                return false;
            }
        }
        // If no route, set default
        return $this->read('');
    }
}
