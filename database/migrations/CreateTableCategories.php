<?php

namespace Migrations;

use Core\Migrate;

class CreateTableCategories {

    public function up() {
        Migrate::createTable('categories', array(
            'id int(10) AUTO_INCREMENT',
            'name varchar(191)',
            'created_at timestamp Default now()',
            'updated_at timestamp Default now()',
            'Primary key (id)',
        ));
    }
}