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

namespace Yso\database;
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

    /**
     * The getData
     * getData gets the data from the database
     * it works according to the PDO scheme:
     * prepare, execute, fetch
     *
     * @param string $sql   : the sql statement
     * @param array  $param : the sql parameters
     *
     * @return object : $res : the result
     */
    public function dbConnect($sql, $param=[]);

}