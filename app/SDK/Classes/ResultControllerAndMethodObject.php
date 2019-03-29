<?php

namespace SDK\Classes;

class ResultControllerAndMethodObject {
    /**
     * Имя контроллера.
     */
    public $controller;

    /**
     * Имя экшена.
     */
    public $action;

    /**
     * Динамическая часть Uri.
     */
    public $urlNumeric;

    /**
     * Имя посредника маршрута.
     */
    public $middleware;

    /**
     * ResultControllerAndMethodObject constructor.
     * @param $controller
     * @param $action
     * @param null $middleware
     * @param null $urlNumeric
     */
    public function __construct($controller, $action, $middleware = null, $urlNumeric = null) {
        $this->controller = $controller;
        $this->action = $action;
        $this->urlNumeric = $urlNumeric;
        $this->middleware = $middleware;
    }
}