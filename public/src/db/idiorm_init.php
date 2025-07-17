<?php

require_once __DIR__ . '/../../../vendor/j4mie/idiorm/idiorm.php';

$config = require_once __DIR__ . '/../config/database.php';

ORM::configure($config['db_driver'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname']);
ORM::configure('username', $config['username']);
ORM::configure('password', $config['password']);

ORM::configure('driver_options', [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
