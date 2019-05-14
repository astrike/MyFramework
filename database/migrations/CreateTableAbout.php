<?php

namespace Migrations;

use Core\Migrate;

class CreateTableAbout {

    public function up() {
        Migrate::createTable('about', array(
            'id int(10) AUTO_INCREMENT',
            'name varchar(191)',
            'title varchar(191)',
            'text text',
            'foto varchar(191)',
            'logo varchar(191)',
            'created_at timestamp default now()',
            'updated_at timestamp default now()',
            'Primary key (id)',
        ));
    }
}