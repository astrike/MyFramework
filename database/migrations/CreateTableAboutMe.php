<?php

namespace Migrations;

use Core\Migrate;

class CreateTableAboutMe {

    public function up() {
        Migrate::createTable('about_me', array(
            'id int(10) AUTO_INCREMENT',
            'text text',
            'created_at timestamp Default now()',
            'updated_at timestamp Default now()',
            'Primary key (id)',
        ));
    }
}