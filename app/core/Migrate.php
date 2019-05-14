<?php
/** Класс миграций */

namespace Core;

class Migrate {

    /**
     * Создание новой таблицы.
     * @param $tableName
     * @param $array
     */
    static public function createTable($tableName, $array) {
        $pdoInstance = self::_createPDOconnection();
        $values = implode(', ', $array);
        $query = "CREATE TABLE $tableName ($values) ENGINE=MyISAM CHARSET=utf8";

        $pdoInstance->query($query);
        $pdoInstance = null;
    }

    /**
     * Удаление необходимой таблицы.
     * @param $tableName
     */
    static public function dropTable($tableName) {
        $pdoInstance = self::_createPDOconnection();
        $query = "DROP TABLE IF EXISTS $tableName";

        $pdoInstance->query($query);
        $pdoInstance = null;
    }

    /**
     * Добавление нового столбца в таблицу.
     * @param $tableName
     * @param $string
     */
    static public function addColumnToTable($tableName, $string) {
        $pdoInstance = self::_createPDOconnection();
        $query = "ALTER TABLE $tableName ADD $string";

        $pdoInstance->query($query);
        $pdoInstance = null;
    }

    /**
     * Удаление столбца из существующей таблицы.
     * @param $tableName
     * @param $columnName
     */
    static public function deleteStringToTable($tableName, $columnName) {
        $pdoInstance = self::_createPDOconnection();
        $query = "ALTER TABLE $tableName DROP COLUMN $columnName";

        $pdoInstance->query($query);
        $pdoInstance = null;
    }

    /**
     * Создание подключения к базе данных
     * @return \PDO
     */
    static private function _createPDOconnection() {
        $database = require getcwd() . '/config/dataBase.php';
        $databaseName     = $database['dbName'];
        $databasePassword = $database['password'];
        $databaseUser     = $database['user'];
        $databaseIP       = $database['ip'];

        return $pdoInstance = new \PDO("mysql:host=$databaseIP;dbname=$databaseName", $databaseUser, $databasePassword);
    }
}