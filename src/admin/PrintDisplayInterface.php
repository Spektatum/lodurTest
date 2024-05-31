<?php
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


namespace Yso\admin;

use Yso\database as database;

use PDO;
use Exception;

// Code validation update:
// Disabling phpcs warning for private vars / methods with underscore
// phpcs:disable PEAR.NamingConventions.ValidFunctionName.PrivateNoUnderscore

/**
 *  PrintDisplay
 *
 *  Php version 8
 *
 * @category Admin
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

interface PrintDisplayInterface
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
     * Print form with cities 
     * 
     * @return string $form : filled in formS
     */
    public function printFormAdd();

    /**
     * Edit data step 1
     * 
     * Get the previous data of a user 
     * Autofill a form for the edit
     * 
     * @return string $dbFeedback : feedback from the database
     */
    public function edit();

    /**
     * Print edit form1
     * 
     * @return string $form : filled in form
     */
    public function printEditForm();

    /**
     * Print delete form
     * 
     * @return string $form : the form
     */
    public function printDeleteForm();

    /**
     * List the users - deleted / not deleted
     * Print html of the content
     * 
     * @param boolean $listDeleted : list only deleted or not
     * @param boolean $xml         : print in xml
     * @param boolean $json        : print in json
     * 
     * @return string $table   : prints html / json / xml table of content
     */
    public function list($listDeleted, $xml = null, $json = null);

    /**
     * Print lists of users & buttons for XML / JSON
     * 
     * @return string $list : return lists & content
     */
    public function printLists();

}
