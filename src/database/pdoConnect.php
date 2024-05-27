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

 // phpcs:disable PEAR.NamingConventions.ValidFunctionName.PrivateNoUnderscore



/**
 *  PDOconnect
 *
 * @category PDOconnect
 * @package  LODUR
 * @author   Ylva Sjölin <yso@spektatum.com>
 * @license  MIT yso@spektatum.com
 * @link     MIT yso@spektatum.com
 **/

class PDOconnect implements PDOconnectInterface
{
    /**
     * The DbBase for PDO - database communication
     *
     * @var object $dbPDO     The database class
     * @var array $dbDetails  The connection details
     */

    public $dbPDO;      // The database PDO connection
    public $dbDetails;  // The database details
    public $setDb;      // Is database set? boolean

    /**
     * Constructor to initiate db connection
     * using login & DSN details
     *
     * @param string $host     : host name
     * @param string $dbName   : database name
     * @param string $user     : login name
     * @param string $password : password
     */
    public function __construct($host, $dbName, $user, $password)
    {

        // If no host or db the db will be unset
        if (!$host || !$dbName ) {
            $this->setDb = false;
            return false;
        }

        // // Set up for phpunit test
        $this->test['prepare'] = false;
        $this->test['execute'] = false;
        $this->test['fetchAll'] = false;

        // if ($test) {
        //     $this->test = $test;
        // }

        // Save connection details
        // $this->dbDetails['host']  = $host;
        // $this->dbDetails['dbName'] = $dbName;
        // $this->dbDetails['user'] = $user;
        // $this->dbDetails['password'] = $password;

        // Connect to database
        $dsn = "mysql:dbname=$dbName;host=$host";
        $user = "$user";
        $password = "$password";
        $utf8 = array(PDO::MYSQL_ATTR_INIT_COMMAND
            => 'SET NAMES \'UTF8\''); // utf8 encoding

        try {
            $this->dbPDO = new PDO($dsn, $user, $password, $utf8);
            // Set attribute to decide how
            // the data from the database will be delivered
            $this->dbPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            $this->setDb = true;

            return true;

        } catch (PDOException $e) {
            //throw $e; // Put on if you want details for the error
            //echo 'Need to fix something: ' . $e->getMessage();

            return false;
        }
    }


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
    public function dbConnect($sql, $param=[])
    {
        if (!$this->setDb) {
            return false;
        }

        // prepare
        $statementPDO = $this->prepare($sql, $param);

        // execute
        $statementPDO = $this->execute($statementPDO, $sql, $param);

        // fetch all
        $res = $this->fetchAll($statementPDO, $param, $sql);

        return $res;
    }


    /**
     * The prepare
     * prepares the data according to PDO system
     * it will use the PDO method 'prepare' to
     * create an object of the PDO Statement Class from the sql
     *
     * @param string : $sql   : the sql statement
     * @param array  : $param : the sql parameters
     *
     * @return object $statementPDO;
     */
    private function prepare($sql, $param)
    {
        // prepare
        $statementPDO = $this->dbPDO->prepare($sql);
        if (!$statementPDO || $this->test['prepare'] == true) {
            // var_dump($param, $sql);
            // var_dump($statementPDO->errorInfo()[2]);
            return [false, $sql, $param];
        }
        return $statementPDO;
    }


    /**
     * The execute
     * execute the data according to PDO system
     * it will use the PDO method 'execute' to
     * execute the sql statement
     *
     * @param object : $statementPDO : the sql statement object
     * @param string : $sql          : the sql statement object
     * @param array  : $params       : the sql parameters
     *
     * @return object $statementPDO;
     */
    private function execute($statementPDO, $sql, $params)
    {
        // execute
        $status = $statementPDO->execute($params);
        if (!$status || $this->test['execute'] == true) {
            // var_dump($param, $sql);
            // var_dump($statementPDO->errorInfo()[2]);
            return [false, $sql, $params];
        }
        return $statementPDO;
    }


    /**
     * The fetch
     * execute the data according to PDO system
     * it will use the PDO method 'fetch' to
     * fetch (collect) the data from the sql statement
     *
     * @param object : $statementPDO : the sql statement object
     * @param array  : $param        : the sql parameters
     * @param string : $sql          : the sql statement
     *
     * @return object $statementPDO;
     */
    private function fetchAll($statementPDO, $param, $sql)
    {
        // fetch all
        $res = $statementPDO->fetchAll();
        if ($res === false || $this->test['fetchAll'] == true) {
            // var_dump($param, $sql);
            // var_dump($statementPDO->errorInfo()[2]);
            return [false, $sql, $param];
        }
        return $res;
    }
}