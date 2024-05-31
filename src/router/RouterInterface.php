<?php
/**
 *  Router Interface
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

interface RouterInterface
{
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
    );

    /**
     * Temporal storage
     * Set temporal storage ($_POST data)
     * and sanitize
     * 
     * @param array $postContent : post content
     * 
     * @return void 
     */
    public function setTempStorage1($postContent);

    /**
     * Temporal storage 2
     * Set temporal storate ($_GET)
     * and sanitize
     * 
     * @param array $getContent : get content
     * 
     * @return void
     */
    public function setTempStorage2($getContent);

    /**
     * Sanitize content
     * Sanitize the content in an array
     * strip for tags & html
     * 
     * @param array $contentArr : array with content
     * 
     * @return array $contentArr : sanitized array
     */
    public function sanitize($contentArr);

    /**
     * Read route & return the data (main function)
     * 
     * @param string $route : the route name
     * 
     * @return mixed $data : the data
     */
    public function read($route);

    /**
     * Get route
     * Get the data for the current 
     * active route stored in the memory ($_GET).
     * Connects with memory & router.
     * So route 'list' returns the lists from the database.
     * 
     * @param string $route : the route for data return
     * 
     * @return mixed $data : returns the data
     */
    public function getRoute($route);

    /**
     * Check route
     * See route is set in the temporal storage ($_GET)
     * 
     * @param string $route : the route for data return
     * 
     * @return mixed $data : returns the data
     */
    public function checkRoute($route);

}
