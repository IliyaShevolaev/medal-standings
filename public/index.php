<?php

use App\Classes\MVC\Router;
use App\db\InitOrm;

require_once __DIR__ . '/../vendor/autoload.php';

InitOrm::init();

$router = new Router($_SERVER['REQUEST_URI']);
$GLOBALS["route"] = $route;

switch ($_SERVER['REQUEST_METHOD']) {
    case ("GET"):
        $router->get();
        break;

    case ("POST"):
        $router->post();
        break;

    default:
        printf('Err');
}
