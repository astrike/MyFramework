<?php
/**
 * Класс приложения Application
 * Mail: mail.usa.va@gmail.com
 * User: astri
 * Date: 2019-03-27
 * Time: 10:48
 */

namespace SDK;

use Jenssegers\Blade\Blade;
use SDK\Facades\Facade;
use SDK\Facades\Route;


class App {

    /**
     * Конфигурация базы данных.
     */
    private $_configDataBase = array();

    /**
     * Конфигурация приложения.
     */
    private $_configApp = array();

    /**
     * Хранилище зарегистрированных роутов.
     */
    private $_routes;

    /**
     * Объект аутентификации.
     */
    private $_authObject;

    /**
     * Имя контроллера полученое из запроса.
     */
    private $_requestControllerClass;

    /**
     * Имя экшена полученое из запроса.
     */
    private $_requestAction;

    /**
     * Имя посредника полученное из запроса.
     */
    private $_middleware;

    /**
     * Пост Дата запроса.
     */
    private $_postRequestData;

    /**
     * Имя метода запроса.
     */
    private $_requestMethod;

    /**
     * Строка Uri.
     */
    private $_requestUri;

    /**
     * Динамическая часть Uri.
     */
    private $_uriNumberString;

    /**
     * Объект ответа.
     */
    private $_response;

    /**
     * Зарегистрированые Алиасы.
     */
    public $aliases;

    /**
     * App constructor.
     */
    public function __construct() {
        $this->_registerConfigDataBase();
        $this->_registerConfigApp();
        $this->_registerCoreContainerAliases();
        $this->_registerFacades();
        $this->_registerRoutes();
        $this->_registerAuthObject();

        $this->_setRequestMethod();
        $this->_setRequestUri();
        $this->_ifPostMethodSetRequestData();
        $this->_calculateRequestControllerClassAndAction();
        $this->_makeControllerAndRunAction ($this->_requestMethod,
            $this->_requestControllerClass,
            $this->_requestAction,
            $this->_middleware,
            $this->_postRequestData,
            $this->_uriNumberString);
    }

    /**
     *Вывод полученого объекта представления.
     */
    public function render() {
        $response = $this->_response;
        if (get_class($response) == 'SDK\Classes\ViewObject') {
            $view = $response->viewFile;
            $variables = $response->viewVariables;
            $variables['auth'] = $this->_authObject;
        } else require '404.html';

        $blade = new Blade(ROOT . '/resources/view', ROOT . '/cache');
        echo $blade->make($view, $variables);
    }

    /**
     * Гетер авторизации
     * @return mixed
     */
    public function getAuthObject() {
        return $this->_authObject;
    }

    /**
     * Создание контроллера и выполнение указаного метода
     * Ответ записывается в хранилище ответов.
     * @param $requestMethod
     * @param $controllerClass
     * @param $action
     * @param $middleware
     * @param $postDataObject
     * @param $uriNumberString
     */
    private function _makeControllerAndRunAction($requestMethod, $controllerClass, $action, $middleware, $postDataObject, $uriNumberString) {

        //если для данного маршрута есть посредник то...
        if ($middleware !== null) {

            //Если посредник пропускает, создает нужный контроллер и выполняем экшен.
            $middlewareClass = 'SDK\\Facades\\' . $middleware;
            if ($middlewareClass::handler()){
                if ($requestMethod == 'POST') {
                    $this->_response = (new $controllerClass())->$action($postDataObject);
                } else {
                    $this->_response = (new $controllerClass())->$action($uriNumberString);
                }
            }
        } else {
            //если посредником нет то просто переходим к выполнению
            if ($requestMethod == 'POST') {
                $this->_response = (new $controllerClass())->$action($postDataObject);
            } else {
                $this->_response = (new $controllerClass())->$action($uriNumberString);
            }
        }

    }

    /**
     * Вычисление нужного контроллера, его метода, посредников и диманической части Uri
     * из URL.
     */
    private function _calculateRequestControllerClassAndAction() {
        $resultControllerAndMethodValue = Route::getRouteParam($this->_requestUri, $this->_requestMethod);

        $this->_requestControllerClass = 'Controllers\\' . $resultControllerAndMethodValue->controller;
        $this->_requestAction = $resultControllerAndMethodValue->action;
        $this->_middleware = $resultControllerAndMethodValue->middleware;
        $this->_uriNumberString = $resultControllerAndMethodValue->urlNumeric;
    }

    /**
     * Получение метода запроса.
     */
    private function _setRequestMethod() {
        $this->_requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Получение Uri.
     */
    private function _setRequestUri() {
        $this->_requestUri = rtrim(ltrim($_SERVER['REQUEST_URI'],'/'),'/');
    }

    /**
     * регистрация фассадов приложения.
     */
    private function _registerFacades() {
        Facade::setFacadeApplication($this);
    }

    /**
     * Регистрация роутов.
     */
    private function _registerRoutes() {
        $this->_routes = require '../routes/routes.php';
    }

    /**
     * Получение конфигов Базы данных.
     */
    private function _registerConfigDataBase() {
        $this->_configDataBase = require ROOT.'/config/dataBase.php';
    }

    /**
     * Получение конфигов Приложения.
     */
    private function _registerConfigApp() {
        $this->_configApp = require ROOT.'/config/app.php';
    }

    /**
     * Регистрация объекта аутентификации
     */
    private function _registerAuthObject() {
       global $auth;

        $this->_authObject = $auth;
    }

    /**
     * Получение PostData при методе запроса - POST.
     */
    private function _ifPostMethodSetRequestData() {
        if ($this->_requestMethod === 'POST') {
            $requestData = array_merge($_FILES, $_POST);

            $postDataObject = new \SDK\Classes\Request();
            foreach ($requestData as $key => $value) {
                $postDataObject->addField($key, $value);
            }
            $this->_postRequestData = $postDataObject;
        }
    }

    /**
     * Регистрация Алиасов приложения.
     */
    private function _registerCoreContainerAliases() {
        $configAlias = require ROOT . '/config/app.php';
        $this->aliases = $configAlias['aliases'];
    }
}