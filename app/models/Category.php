<?php
/*
 * Модель Категорий.
 * В объекте $table задается имя таблицы в базе
 */

namespace Models;

class Category
{
    use Model;

    static $table = 'categories';
}