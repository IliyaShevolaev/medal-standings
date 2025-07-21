<?php

use App\classes\MVC\Router;


Router::get('/myURL', [TestController::class, 'test']);
Router::get('/second', [TestController::class, 'test1']);