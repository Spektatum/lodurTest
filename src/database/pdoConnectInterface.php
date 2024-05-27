<?php
/**
 *  PDOconnection
 *  Connect to a MySQL database with PDO
 *  php version 8
 *
 * @category DbConnection
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT https://www.spektatum.com
 * @link     https://www.spektatum.com
 **/

namespace Lodur\database;
use PDO;
use Exception;
use PDOException;

/**
 *  PDOconnectInterface
 *
 * @category PDOconnect
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT yso@spektatum.com
 * @link     MIT yso@spektatum.com
 **/
interface PDOconnectInterface
{
    /**
     * Constructor to initiate db connection
     * using login & DSN details
     *
     * @param string $host     : host name
     * @param string $dbName   : database name
     * @param string $user     : login name
     * @param string $password : password
     */
    public function __construct($host, $dbName, $user, $password);

}