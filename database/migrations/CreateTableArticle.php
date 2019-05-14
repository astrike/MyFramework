<?php

namespace Migrations;

use Core\Migrate;

class CreateTableArticle {

    public function up() {
        Migrate::createTable('articles', array(
            'id int(10) AUTO_INCREMENT',
            'category_id varchar(191)',
            'title varchar(191)',
            'text text',
            'image varchar(191)',
            'user_id int(10)',
            'views int(11) DEFAULT NULL',
            'created_at timestamp Default now()',
            'updated_at timestamp Default now()',
            'Primary key (id)',
        ));
    }
}