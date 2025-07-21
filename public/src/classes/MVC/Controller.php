<?php

namespace App\Classes\MVC;

class Controller
{
    protected function redirect($uri): void
    {
        header('Location: ' . $uri);
        die();
    }
}