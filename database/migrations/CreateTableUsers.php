<?php

namespace Migrations;

use Core\Migrate;

class CreateTableUsers {

    public function up() {
        Migrate::createTable('users', array(
            'id int(10) AUTO_INCREMENT',
            'email varchar(249) NOT NULL',
            'password varchar(255) NOT NULL',
            'username varchar(100) NOT NULL',
            'status tinyint(2) NOT NULL DEFAULT 0',
            'verified tinyint(1) NOT NULL DEFAULT 0',
            'resettable tinyint(1) NOT NULL DEFAULT 1',
            'roles_mask int(10) NOT NULL DEFAULT 0',
            'registered int(10) NOT NULL',
            'last_login int(10) DEFAULT NULL',
            'force_logout mediumint(7) NOT NULL DEFAULT 0',
            'avatar varchar(249) DEFAULT NULL',
            'Primary key (id)',
        ));
    }
}