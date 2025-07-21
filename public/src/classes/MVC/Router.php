<?php

namespace App\classes\MVC;

class Router
{
    private static $routesGet = [];

    public static function get(string $url, array $controller)
    {
        self::$routesGet[] = [
            'url' => $url,
            'controller' => [
                    'class' => $controller[0],
                    'action' => $controller[1]
                ]
        ];

        // var_dump(self::$routesGet);
        // echo '<br>';
    }

    public static function test()
    {
        echo 'router';
    }
}   