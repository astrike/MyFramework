<?php
/*
 * Модель Статей.
 * В объекте $table задается имя таблицы в базе
 */

namespace Models;

class Article
{
    use Model;

    static $table = 'articles';
}