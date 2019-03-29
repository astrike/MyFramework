<?php

/**
 * Удобная функция дебага
 * @param $arr
 */
function debug($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

/**
 * @param $view
 * @param array $variables
 * @return \SDK\Classes\ViewObject
 */
function view($view, $variables = []) {
    $viewInfo = [];
    $viewInfo['view'] = $view;
    $viewInfo['variables'] = $variables;

    return new \SDK\Classes\ViewObject($viewInfo['view'], $viewInfo['variables']);
}

function redirect($uri) {
    header('Location: '. $uri);
}

/**
 * Объект в массив
 * @param $object
 * @return array
 */
function object_to_array($object) {
    $array = array();
    foreach ($object as $key => $value) {
        $array[$key] = $value;
    }
    return $array;
}

/**
 * Массив в объект Коллекций
 * @param array $array
 * @return \SDK\Classes\CollectionObject
 */
function array_to_collectionObject(array $array) {
    $object = new \SDK\Classes\CollectionObject();
    foreach ($array as $key => $value) {
        $object->addField($key, $value);
    }
    return $object;
}

/**
 * Вспомогательная функция правильно указывающая
 * путь к необходимому файлу
 * @param $fileOrFolder
 * @return string
 */
function asset($fileOrFolder) {
    return '/' . $fileOrFolder;
}

/**
 * Возвращает рандомную строку нужной длины
 * @param int $length
 * @return bool|string
 */
function quickRandom($length = 16)
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
}

/**
 * Возвращает имя файла.
 * @param $request
 * @return mixed
 */
function getFullFileNameFromRequestImage($request) {
    return $request->image['name'];
}

/**
 * Возвращает имя временного файла.
 * @param $request
 * @param null $name
 * @return mixed
 */
function getTempFilePathFromRequest($request, $name = null) {
    if ($name !== null) {
        return $request->$name['tmp_name'];
    } else {
        return $request->image['tmp_name'];
    }

}

/**
 * Получение файлов из объекта Request
 * @param $request
 * @return mixed
 */
function extensionFileFromRequest($request) {
    $imageExtension = trim($request->image['type']);
    $imageExtension = explode('/', $imageExtension);
    return  array_pop($imageExtension);
}

/**
 * Создание и передача объекта Pdo базы данных.
 * @return \Delight\Db\PdoDsn
 */
function getPDO() {
    $dataBaseConfig = require ROOT.'/config/dataBase.php';
    $dataBaseConfigString = 'mysql:dbname=' . $dataBaseConfig['dbName'] . ';host=' . $dataBaseConfig['ip'] . ';port=' . $dataBaseConfig['port'] . ';charset=' . $dataBaseConfig['charset'];

    return new \Delight\Db\PdoDsn($dataBaseConfigString, $dataBaseConfig['user'], $dataBaseConfig['password']);
}

/**
 * Создание объекта аутентификации.
 * @return \Delight\Auth\Auth
 */
function getAuth() {
    $db = getPDO();
    return new \Delight\Auth\Auth($db);
}