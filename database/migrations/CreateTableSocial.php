<?php

namespace Migrations;

use Core\Migrate;

class CreateTableSocial {

    public function up() {
        Migrate::createTable('social', array(
            'id int(10) AUTO_INCREMENT',
            'ok varchar(191) DEFAULT NULL',
            'vk varchar(191) DEFAULT NULL',
            'inst varchar(191) DEFAULT NULL',
            'utub varchar(191) DEFAULT NULL',
            'created_at timestamp Default now()',
            'updated_at timestamp Default now()',
            'Primary key (id)',
        ));
    }
}