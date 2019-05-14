<?php

include 'vendor/autoload.php';

//достаем список миграций из папки
$allMigrations = scandir(getcwd() . '/database/migrations/');

//перебираем и выполняем их
foreach ($allMigrations as $migration) {
    if (substr($migration, -4) === '.php') {

        $className = '\Migrations\\' . rtrim($migration, '.php');
        (new $className())->up();
    }
}

