<?php

//Подключение хелперов
require '../bootstrap/helpers/helpers.php';

//Подключение констант
define('ROOT', dirname(__DIR__));

//создание экземпляра аутентификации
$auth = getAuth();


//Создание экземпляра приложения и получение ответа
$container = \Illuminate\Container\Container::getInstance();

$app = $container->make('\\SDK\\App');
$app->render();