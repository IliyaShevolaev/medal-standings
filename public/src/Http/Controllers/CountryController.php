<?php

namespace App\Http\Controllers;

use App\classes\MVC\Controller;
use App\classes\MVC\View;
use App\models\CountryModel;

require_once __DIR__ . '/../../db/idiorm_init.php';

class CountryController extends Controller
{
    public function index()
    {
        $countries = CountryModel::all();
        
        View::make('countries/add.tpl', [
            'countries' => $countries
        ]);
    }

    public function create(array $requestData)
    {
        CountryModel::create([
            'name' => $requestData['name']
        ]);

        $this->redirect('/countries');
    }

    public function delete(array $requestData): void
    {
        CountryModel::delete($requestData['id']);
        
        $this->redirect('/countries');
    }
}