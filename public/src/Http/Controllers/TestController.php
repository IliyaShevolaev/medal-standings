<?php

namespace App\Http\Controllers;

use App\classes\MVC\Controller;

class TestController extends Controller
{
    public function test()
    {
        echo 'test';
    } 

    public function new()
    {
        echo 'new';
    } 
}