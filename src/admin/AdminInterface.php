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

// Code validation update:
// Disabling phpcs warning for private vars / methods with underscore
// phpcs:disable PEAR.NamingConventions.ValidFunctionName.PrivateNoUnderscore

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

interface AdminInterface
{
    /**
     * Constructor
     * 
     * @param object $database : the database connection object
     */
    public function __construct(
        database\PDOconnectInterface $database
    );

    /**
     * Set post data property
     * 
     * @param array $postContent : post content
     * 
     * @return string $var : sanitized var
     */
    public function setTempStorage1($postContent);

    /**
     * Add to the database
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function add();

    /**
     * Edit data step 2
     * 
     * Update with the new user data
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function edit2();
    
    /**
     * Delete (soft)
     * 
     * SOFT DELETES from the database (marks as deleted)
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function delete();

    /**
     * Delete (hard)
     * 
     * Removes it from the database
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function hardDelete();

}
