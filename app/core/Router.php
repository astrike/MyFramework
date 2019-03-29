<?php

namespace Core;

use SDK\Classes\ResultControllerAndMethodObject;

class Router
{
    /**
     * Хранилище всех возможных роутов.
     */
    protected static $allRoutes = [];

    /**
     * Текущий роут.
     */
    protected static $route = [];

    /**
     * Динамическая часть роута
     */
    protected static $urlNumeric = false;

    /**
     * Добавление Get роутов в хранилище
     * @param string $routeString
     * @param array $routeData
     */
    public static function get($routeString, $routeData = []){
        $routeData['method'] = 'GET';
        if ($routeString !== '/'){
            $routeString = trim($routeString, '/');
        }
        self::$allRoutes[$routeData['method'] . '-' . $routeString] = $routeData;
    }
    /**
     * Добавление Post роутов в хранилище
     * @param string $routeString
     * @param array $routeData
     */
    public static function post($routeString, $routeData = []){
        $routeData['method'] = 'POST';
        if ($routeString !== '/'){
            $routeString = trim($routeString, '/');
        }
        self::$allRoutes[$routeData['method'] . '-' . $routeString] = $routeData;
    }

    /**
     * Получение параметров роута
     * @param string$url
     * @param string $method
     * @return ResultControllerAndMethodObject
     */
    public static function getRouteParam($url, $method){
        if(self::_routeMatch($url, $method)){
            $controller = 'Controllers\\' . self::$route['controller'];
            if(class_exists($controller)){
                $obj = new $controller(self::$route);
                $action =  self::$route['action'];

                if (method_exists($obj, $action)){
                    unset($obj);
                    return new ResultControllerAndMethodObject(self::$route['controller'], self::$route['action'], self::$route['middleware'], self::$urlNumeric);
                }else{
                    echo 'Метод ' . $action . ' класса ' . $controller . ' не найден';
                }
            }else{
                echo 'Класс ' . $controller . ' не найден';
            }
        }else{
            include '404.html';
            exit;
        }
    }

    /**
     * Вычисление параметров текущего роута.
     * @param string $url
     * @param string $method
     * @return bool
     */
    private static function _routeMatch($url, $method){
        //если урл пуст - вставляем в него '/'
        if ($url === '') {
            $url = '/';
        }
        $url = $method . '-' . $url;
        //перебираем все елементы со строками роутов
        foreach (self::$allRoutes as $routeString => $route){

            //если в строке нет элементов с динамическими элементами в скобках {}
            if (strpos($routeString, '{') === false) {

                //если строка с роутом равна строки из урла то...
                if ($routeString == $url && $route['method'] == $method) {

                    //ниже заполняем данные об нужном контроллере и методе
                    //на основании данных из урла
                    self::$route['controller'] = $route['controller'];
                    self::$route['action']     = $route['action'];
                    self::$route['middleware'] = isset($route['middleware']) ? $route['middleware'] : null;

                    return true;
                }
            } else {
                //массив строк из роута разделенный слешем
                $routeStringArray = explode('/', $routeString);

                //массив строк из урла разделенных слешем
                $urlArray = explode('/', $url);

                //получение последней строки из массива урла
                // и его непосредственного удаления из массива
                $numeric = array_pop($urlArray);

                //если последний элемент урла - число то...
                if (is_numeric($numeric)) {

                    //удаляем последний элемент из массива текущего роута
                    array_pop($routeStringArray);

                    //если массивы равны то заполняем нужные данные
                    //контроллера и метода
                    if ($routeStringArray == $urlArray && $route['method'] == $method) {
                        self::$route['controller'] = $route['controller'];
                        self::$route['action']     = $route['action'];
                        self::$route['middleware'] = isset($route['middleware']) ? $route['middleware'] : null;
                        self::$urlNumeric          = $numeric;

                        return true;
                    }
                }
            }
        }
        return false;
    }
}