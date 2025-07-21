<?php

use App\classes\MVC\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/src/routes/route.php';
// require_once __DIR__ . '/src/pages/main.php';

$router = new Router($_SERVER['REQUEST_URI']);
$GLOBALS["route"] = $route;

switch ($_SERVER['REQUEST_METHOD']) {
    case ("GET"):
        $router->get();
        break;

    case ("POST"):
        //$router->post();
        break;

    default:
        printf('Err');
}

?>