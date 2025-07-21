<?php

namespace App\Http\Controllers;

use App\Classes\MVC\Controller;
use App\Classes\MVC\View;
use App\models\CountryModel;

class CountryController extends Controller
{
    public function create(): void
    {
        $countries = CountryModel::all();
        
        View::make('countries/add.tpl', [
            'countries' => $countries
        ]);
    }

    public function store(array $requestData): void
    {
        CountryModel::create([
            'name' => $requestData['name']
        ]);

        $this->redirect('/countries/create');
    }

    public function delete(array $requestData): void
    {
        CountryModel::delete($requestData['id']);

        $this->redirect('/countries/create');
    }
}