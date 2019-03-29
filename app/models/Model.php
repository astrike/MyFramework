<?php

namespace models;

use SDK\Classes\CollectionObject;
use SDK\Classes\ModelObject;

Trait Model {
    /**
     * объект базы данных.
     */
    static $mysqli;


    /**
     * Проверка существования таблице в базе.
     */
    static function check(){
        if (!isset(self::$table) or self::$table == '') {
            echo 'Не задана таблица БД для данной модели';
            exit();
        }else{
            return true;
        }
    }

    /**
     * Соеденение с базой данных.
     */
    static function connectBD(){
        $db_config = require ROOT.'/config/dataBase.php';
        self::$mysqli = new \mysqli($db_config['ip'],$db_config['user'],$db_config['password'],$db_config['dbName'],$db_config['port']);
        self::$mysqli->query('SET charset utf8');
    }

    /**
     * Закрытие соеденения с базой данных.
     */
    static function closeBD(){
        self::$mysqli->close();
    }

    /**
     * Получение колекции всех записей из данной таблицы.
     * @return CollectionObject
     */
    static function All(){
        if (self::check()){
            $table = self::$table;
        }
        self::connectBD();
        $query = 'SELECT * FROM ' . $table;
        $result = self::$mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        self::closeBD();

        return self::_createCollectionFromCollectionArray($output);
    }

    /**
     * Получение одного экземпляра модели по заданному ID
     * @param integer $id
     * @param string $field
     * @return ModelObject
     */
    static function find($id, $field = ''){
        if (self::check()){
            $table = self::$table;
        }
        self::connectBD();
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . ($k = $field ?: 'ID') . ' = ' . '\'' . $id . '\'' . ' LIMIT 1';;
        $result = self::$mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output = $row;
        }
        if (!isset($output)) {
            $output = [];
        }
        self::closeBD();

        $newCollectionObject = new ModelObject(self::$table);
        foreach ($output as $key => $value) {
            $newCollectionObject->addField($key, $value);
        }

        return $newCollectionObject;
    }

    /**
     * Получение коллекции экземпляров удовлетворяющих условию.
     * @param $focus
     * @param $finding
     * @return ModelObject
     */
    static function where($focus, $finding){
        if (self::check()){
            $table = self::$table;
        }
        self::connectBD();
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $focus . ' = ' . '\'' . $finding . '\'';
        $result = self::$mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        self::closeBD();

        $newCollectionObject = new ModelObject(self::$table);
        foreach ($output as $key => $value) {
            $newCollectionObject->addField($key, $value);
        }
        $newCollectionObject->addField('table', self::$table);

        return $newCollectionObject;
    }

    /**
     * Запись информации в базу
     * @param mixed $items
     * @return bool
     */
    static function create($items){
        $table = self::$table;
        self::connectBD();
        $key = '';
        $value = '';
        foreach ($items as $k => $item){
            $key .= "`" . $k . "`, ";
            $value .= '\'' . $item . '\', ';
        }
        $query = 'INSERT INTO ' . $table . ' ( ' . rtrim($key,', ') . ' ) VALUES ( ' . rtrim($value,', ') . ' )';
        echo $query;
        $result = self::$mysqli->query($query);
        self::closeBD();
        if ($result){
            return true;
        }
    }

    /**
     * Удаление из базы по id.
     * @param integer $id
     */
    static function destroy($id){
        if (self::check()){
            $table = self::$table;
        }
        self::connectBD();
        $query = 'DELETE FROM ' . $table . ' WHERE ID = ' . '\'' . $id . '\'';
        self::$mysqli->query($query);
        self::closeBD();
    }

    /**
     * Выполнение указанного запроса.
     * @param string $query
     * @return array
     */
    static function query($query){
        self::connectBD();
        $result = self::$mysqli->query($query)?:[];
        self::closeBD();
        return $result;
    }

    /**
     * Поиск по ключевому слову.
     * @param $focus
     * @param $field
     * @param string $table
     * @return ModelObject
     */
    static function findLike($focus, $field, $table = ''){
        if (self::check()){
            $table = self::$table;
        }
        $table = $table ?: self::$table;
        self::connectBD();
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $field . ' LIKE ' . '\'%' . $focus . '%\'';
        $result = self::$mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        self::closeBD();

        return self::_createCollectionFromCollectionArray($output);
    }

    /**
     * Получение всех данных по указанной таблице с сортировкой по полю.
     * @param string $fieldToSort
     * @param bool $sortMethod
     * @return CollectionObject
     */
    static function orderBy ($fieldToSort, $sortMethod = false) {
        if (self::check()){
            $table = self::$table;
        }
        self::connectBD();
        $query = 'SELECT * FROM ' . $table;
        $result = self::$mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        self::closeBD();

        $output = self::_customMultiSort($output, $fieldToSort);
        if ($sortMethod == 'DESC') {
            $output = array_reverse($output);
        }

        return self::_createCollectionFromCollectionArray($output);
    }

    /**
     * Сортируем многомерный массив по значению вложенного массива
     * @param $array array многомерный массив который сортируем
     * @param $field string название поля вложенного массива по которому необходимо отсортировать
     * @return array отсортированный многомерный массив
     */
    private static function _customMultiSort($array, $field) {
        $sortArr = array();
        foreach($array as $key => $val){
            $sortArr[$key] = $val[$field];
        }
        array_multisort($sortArr, $array);
        return $array;
    }

    /**
     * Создание коллекции из массива коллекций
     * @param $output
     * @return ModelObject
     */
    private static function _createCollectionFromCollectionArray($output) {
        //массив с промежуточными данными(объектами коллекций)
        $outputData = array();
        foreach ($output as $element) {
            if (is_array($element)){
                $newCollectionObject = new ModelObject(self::$table);
                foreach ($element as $key => $value) {
                    $newCollectionObject->addField($key, $value);
                }
                $outputData[] = $newCollectionObject;
            }
        }
        //создаем коллекцию состоящую из подколлекций
        $collectionObject = new ModelObject(self::$table);
        foreach ($outputData as $key => $value) {
            $collectionObject->addField($key, $value);
        }
        return $collectionObject;
    }
}
