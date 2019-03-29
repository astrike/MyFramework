<?php

namespace SDK\Classes;

class Request implements \Countable
{
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
        return $count;
    }

    /**
     * Отбор из коллекции данных заданых в условии.
     * @param $findingName
     * @param $findingValue
     * @return CollectionObject
     */
    public function where ($findingName, $findingValue) {
        $newObject = new CollectionObject();
        foreach (get_object_vars($this) as $element) {
            if ($element->$findingName == $findingValue) {
                $newObject->addField(rand(1,1000), $element);
            }
        }
        return $newObject;
    }
}