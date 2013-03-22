<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2013 Patrick Farnkopf
* @link https://github.com/PatrickFarnkopf/pCMS
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

namespace Classes;
class MySQL extends \Classes\Singleton implements \Config\MySQL {
    public function __construct($data = false) {
        try {
            if (!$data) {
                $dsn = 'mysql:host='.\Config\MySQL::HOST_ADDRESS;
                $this->pdoInstance = new \PDO($dsn, \Config\MySQL::USERNAME, \Config\MySQL::PASSWORD);
                $this->selectDatabase(\Config\MySQL::DATABASE);
            } else {
                $dsn = 'mysql:host='.$data[\Classes\Server::MYSQL_HOST];
                $this->pdoInstance = new \PDO($dsn, $data[\Classes\Server::MYSQL_USER], $data[\Classes\Server::MYSQL_PASS]);
                if (isset($data[\Classes\Server::MYSQL_DB])) $this->selectDatabase($data[\Classes\Server::MYSQL_DB]);
            }
            $this->isAlive = true;
            $this->pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            $this->isAlive = false;
        }
    }

    public function selectDatabase($db) {
        try {
            $this->Query('USE '.$db);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

   /**
    *   Führt Query aus und gibt einen Klon von $this zurück
    *   @param (String) Query
    *   @return Result Instanz
    */
    public function Query($query) {
        try {
            $result = $this->pdoInstance->query($query);
            return new \Classes\MySQL\Result($result);
        } catch (\Exception $e) {
            return false;
        }
    }

   /**
    *   Neue Instanz zum Bearbeiten von Tabellen
    *   @param String Tabellenname
    *   @return TableAction
    */
    public function tableAction($table) {
        try {
            return new \Classes\MySQL\TableAction($this, $table);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function isAlive() {
        return $this->isAlive;
    }

    private $prepStmt, $stmtData = [], $pdoInstance, $isAlive;
}

?>
