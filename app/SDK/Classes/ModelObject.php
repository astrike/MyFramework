<?php

namespace SDK\Classes;

class ModelObject implements \Countable
{
    use \SDK\Traits\ModelNonStatic;

    /**
     * Название таблицы данного объекта.
     * ModelObject constructor.
     * @param $table
     */
    private $table;

    /**
     * ModelObject constructor.
     * @param $table
     */
    public function __construct($table) {
        $this->table = $table;
    }

    /**
     * Добавление нового свойства данного объекта.
     * @param $key
     * @param $value
     */
    public function addField ($key, $value) {
        $this->$key = $value;
    }

    /**
     * Count elements of an object
     * @link https://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count() {
        $count = 0;
        foreach (get_object_vars($this) as $e) {
            $count++;
        };
        return $count - 2;
    }

    /**
     * Отбор из коллекции данных заданых в условии.
     * @param $findingName
     * @param $findingValue
     * @return ModelObject
     */
    public function where ($findingName, $findingValue) {
        $newObject = new ModelObject($this->table);
        foreach (get_object_vars($this) as $element) {
            if (is_object($element)) {
                if ($element->$findingName == $findingValue) {
                    $newObject->addField(rand(1, 1000), $element);
                }
            }
        }
        return $newObject;
    }

    /**
     * Удаление из таблицы элемента.
     */
    public function delete() {
        $table = $this->table;

        foreach ($this as $record) {
            if (is_object($record)) {
                $id = $record->id;
                $this->connectBD();
                $query = 'DELETE FROM ' . $table . ' WHERE ID = ' . '\'' . $id . '\'';
                $this->mysqli->query($query);
                $this->closeBD();
            }
        }
    }

    /**
     * Реверс елементов объекта.
     * @return ModelObject
     */
    public function reverse() {
        $newObject = new ModelObject($this->table);
        $tempArray = object_to_array($this);
        $tempArray = array_reverse($tempArray);

        foreach ($tempArray as $key => $element) {
            $newObject->addField($key, $element);
        }
        return $newObject;
    }
}