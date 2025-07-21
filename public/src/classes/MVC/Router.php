<?php

namespace App\classes\MVC;

class Router
{
    private $uri;

    public function __construct($uri = '/')
    {
        $this->uri = $uri;
        if (isset($_GET)) {
            $this->uri = strtok($this->uri, '?');
        }
    }

    public function getUri()
    {
        return $this->uri;
    }

    protected function findRoute($method, $uri)
    {
        $routes = require __DIR__ . '/../../routes/route.php';

        foreach ($routes as $route) {
            if ($route[0] == $method && $route[1] == $uri) {
                return $route;
            }
        }
    }

    public function get() {
        $route = $this->findRoute('GET', $this->uri);

        if($route != NULL) {
            $class = "App\Http\Controllers\\".$route[2];
            $controller = new $class();

            return call_user_func(array($controller, $route[3]), $_GET);
        }
        else {
            var_dump('error get');
        }
    }

    public function post() 
    {
        $route = $this->findRoute('POST', $this->uri);

        if($route != NULL) {
            $class = "App\Http\Controllers\\".$route[2];
            $controller = new $class();

            return call_user_func(array($controller, $route[3]), $_POST);
        }
        else {
            var_dump('error post');
        }
    }
}