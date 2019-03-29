<?php

namespace SDK\Traits;

use SDK\Classes\CollectionObject;
use SDK\Classes\ModelObject;

trait ModelNonStatic
{
    /**
     * объект базы данных.
     */
    private $mysqli;

    /**
     * Текущая таблица.
     */
    private $table;

    /**
     * Проверка существования таблице в базе.
     */
    public function check(){
        if (!isset($this->table) or $this->table == '') {
            echo 'Не задана таблица БД для данной модели';
            exit();
        }else{
            return true;
        }
    }

    /**
     * Соеденение с базой данных.
     */
    public function connectBD(){
        $db_config = require ROOT.'/config/dataBase.php';
        $this->mysqli = new \mysqli($db_config['ip'],$db_config['user'],$db_config['password'],$db_config['dbName'],$db_config['port']);
        $this->mysqli->query('SET charset utf8');
    }

    public function closeBD(){
        $this->mysqli->close();
    }


    /**
     * Получение колекции всех записей
     * @return CollectionObject
     */
    public function All(){
        if ($this->check()){
            $table = $this->table;
        }
        $this->connectBD();
        $query = 'SELECT * FROM ' . $table;
        $result = $this->mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        $this->closeBD();

        $newCollectionObject = new CollectionObject();
        foreach ($output as $key => $value) {
            $newCollectionObject->addField($key, $value);
        }

        return $this->_createCollectionFromCollectionArray($output);
    }

    /**
     * Получение одного экземпляра модели по заданному ID
     * @param $id
     * @param string $field
     * @return ModelObject
     */
    public function find($id, $field = ''){
        if ($this->check()){
            $table = $this->table;
        }
        $this->connectBD();
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . ($k = $field ?: 'ID') . ' = ' . '\'' . $id . '\'' . ' LIMIT 1';;
        $result = $this->mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output = $row;
        }
        if (!isset($output)) {
            $output = [];
        }
        $this->closeBD();

        $newCollectionObject = new ModelObject($this->table);
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
    public function where($focus, $finding){
        if ($this->check()){
            $table = $this->table;
        }
        $this->connectBD();
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $focus . ' = ' . '\'' . $finding . '\'';
        $result = $this->mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        $this->closeBD();

        $newCollectionObject = new ModelObject($this->table);
        foreach ($output as $key => $value) {
            $newCollectionObject->addField($key, $value);
        }
        $newCollectionObject->addField('table', $this->table);

        return $newCollectionObject;
    }

    /**
     * Запись информации в базу
     * @param mixed $items
     * @return bool
     */
    public function create($items){
        if ($this->check()){
            $table = $this->table;
        }
        $this->connectBD();
        $key = '';
        $value = '';
        foreach ($items as $k => $item){
            $key .= '' . $k . ', ';
            $value .= '\'' . $item . '\', ';
        }
        $query = 'INSERT INTO ' . $table . ' ( ' . rtrim($key,', ') . ' ) VALUES ( ' . rtrim($value,', ') . ' )';
        $result = $this->mysqli->query($query);
        $this->closeBD();
        if ($result){
            return true;
        }
    }

    /**
     * Удаление из базы по id.
     * @param integer $id
     */
    public function destroy($id){
        if ($this->check()){
            $table = $this->table;
        }
        $this->connectBD();
        $query = 'DELETE FROM ' . $table . ' WHERE ID = ' . '\'' . $id . '\'';
        $this->mysqli->query($query);
        $this->closeBD();
    }

    /**
     * Выполнение указанного запроса.
     * @param string $query
     * @return array
     */
    public function query($query){
        $this->connectBD();
        $result = $this->mysqli->query($query)?:[];
        $this->closeBD();
        return $result;
    }

    /**
     * Поиск по ключевому слову.
     * @param $focus
     * @param $field
     * @param string $table
     * @return ModelObject
     */
    public function findLike($focus, $field, $table = ''){
        if ($this->check()){
            $table = $this->table;
        }
        $table = $table ?: $this->table;
        $this->connectBD();
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $field . ' LIKE ' . '\'%' . $focus . '%\'';
        $result = $this->mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        $this->closeBD();

        return $this->_createCollectionFromCollectionArray($output);
    }

    /**
     * @param $fieldToSort
     * @param bool $sortMethod
     * @return CollectionObject
     */
    public function orderBy ($fieldToSort, $sortMethod = false) {
        if ($this->check()){
            $table = $this->table;
        }
        $this->connectBD();
        $query = 'SELECT * FROM ' . $table;
        $result = $this->mysqli->query($query);
        while ($row = $result->fetch_assoc()) {
            $output[] = $row;
        }
        if (!isset($output)) $output = [];
        $this->closeBD();

        $output = $this->_customMultiSort($output, $fieldToSort);
        if ($sortMethod == 'DESC') {
            $output = array_reverse($output);
        }

        return $this->_createCollectionFromCollectionArray($output);
    }

    /**
     * Сортируем многомерный массив по значению вложенного массива
     * @param $array array многомерный массив который сортируем
     * @param $field string название поля вложенного массива по которому необходимо отсортировать
     * @return array отсортированный многомерный массив
     */
    public function _customMultiSort($array, $field) {
        $sortArr = array();
        foreach($array as $key => $val){
            $sortArr[$key] = $val[$field];
        }

        array_multisort($sortArr, $array);
        return $array;
    }

    /**
     * Обновление записей в базе данных по полученным данным.
     * @param $arrayNewData
     * @return bool
     */
    public function update($arrayNewData) {
        if ($this->check()){
            $tableForMySQLRequest = $this->table;
        }

        $stringForMySQLRequest = '';
        if (isset($this->id)){
            foreach ($arrayNewData as $field => $value) {
                $stringForMySQLRequest .= "`" . $field . "`='" . $value . "',";
            }
            $stringForMySQLRequest = rtrim($stringForMySQLRequest, ',');
            $stringWHERE = "`id`='" . $this->id . "'";
            $this->connectBD();
            $query = 'UPDATE ' . $tableForMySQLRequest . ' SET ' . $stringForMySQLRequest . ' WHERE ' . $stringWHERE;
            $this->query($query);
            $this->closeBD();
            return true;
        } else {
            die('Обновляется не найденая запись!!!');
        }
    }

    /**
     * Создание коллекции из массива коллекций
     * @param $output
     * @return CollectionObject
     */
    private function _createCollectionFromCollectionArray($output) {
        //массив с промежуточными данными(объектами коллекций)
        $outputData = array();
        foreach ($output as $element) {
            if (is_array($element)){
                $newCollectionObject = new CollectionObject();
                foreach ($element as $key => $value) {
                    $newCollectionObject->addField($key, $value);
                }
                $outputData[] = $newCollectionObject;
            }
        }

        //создаем коллекцию состоящую из подколлекций
        $collectionObject = new CollectionObject();
        foreach ($outputData as $key => $value) {
            $collectionObject->addField($key, $value);
        }
        return $collectionObject;
    }
}