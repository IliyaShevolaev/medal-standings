<?php

namespace App\Http\Controllers;

use App\classes\MVC\Controller;
use App\classes\MVC\View;
use ORM;

require_once __DIR__ . '/../../db/idiorm_init.php';

class CountryController extends Controller
{
    public function index()
    {
        $countries = ORM::forTable('countries')->findArray();
        
        View::make('countries/add.tpl', [
            'countries' => $countries
        ]);
    }
}