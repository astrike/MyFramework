<?php
/**
 * Created by PhpStorm.
 * User: astri
 * Date: 2019-03-25
 * Time: 17:33
 */

namespace SDK\Classes;


use Jenssegers\Blade\Blade;

class ViewObject
{
    /**
     * Имя представления.
     */
    public $viewFile;

    /**
     * Массив переменных со значениями.
     */
    public $viewVariables = array();

    /**
     * ViewObject constructor.
     * @param $viewFile
     * @param $viewVariables
     */
    public function __construct($viewFile, $viewVariables) {
        $this->viewFile = $viewFile;
        $this->viewVariables = $viewVariables;
    }

    /**
     * Функция вывода представления.
     * @param $viewObject
     * @return mixed
     */
    public function render($viewObject) {
        $view = $viewObject->viewFile;
        $variables = $viewObject->viewVariables;

        $blade = new Blade(ROOT . '/resources/view', ROOT . '/cache');
        return $blade->make($view, $variables);
    }

}