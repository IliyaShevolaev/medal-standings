<?php

namespace App\Classes\MVC;

class Router
{
    private $uri;
    private $uriSkipEntityWords = [''];

    private function parseEntityName(): string
    {
        $currentEntityName = '';
        foreach (explode('/', $this->uri) as $uriPart) {
            if (!in_array($uriPart, $this->uriSkipEntityWords)) {
                $currentEntityName = $uriPart;
                break;
            }
        }

        return $currentEntityName;
    }

    public function __construct($uri = '/')
    {
        $this->uri = $uri;
        if (isset($_GET)) {
            $this->uri = strtok($this->uri, '?');
        }
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    protected function findRoute(string $method, string $uri): mixed
    {
        $routes = require __DIR__ . '/../../routes/route.php';
        $currentEntity = $this->parseEntityName();

        if (!isset($routes[$currentEntity])) {
            return ['GET', '/medal', 'MedalController', 'index'];
        }

        foreach ($routes[$currentEntity] as $route) {
            if ($route[0] == $method && $route[1] == $uri) {
                return $route;
            }
        }

        return null;
    }

    public function get(): mixed
    {
        $route = $this->findRoute('GET', $this->uri);

        if ($route != NULL) {
            $class = "App\Http\Controllers\\" . $route[2];
            $controller = new $class();

            return call_user_func(array($controller, $route[3]), $_GET);
        } else {
            var_dump('error get');

            return null;
        }
    }

    public function post(): mixed
    {
        $route = $this->findRoute('POST', $this->uri);

        if ($route != NULL) {
            $class = "App\Http\Controllers\\" . $route[2];
            $controller = new $class();

            return call_user_func(array($controller, $route[3]), $_POST);
        } else {
            var_dump('error post');

            return null;
        }
    }
}