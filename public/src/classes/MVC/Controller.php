<?php

namespace App\classes\MVC;

class Controller
{
    protected function redirect($uri): void
    {
        header('Location: ' . $uri);
        die();
    }
}