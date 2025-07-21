<?php

namespace App\Http\Controllers;

use App\Classes\MVC\Controller;
use App\Classes\MVC\View;
use App\models\SportTypeModel;

class SportTypeController extends Controller
{
    public function create(): void
    {
        $sportTypes = SportTypeModel::all();
        
        View::make('sport_types/add.tpl', [
            'sportTypes' => $sportTypes
        ]);
    }

    public function store(array $requestData): void
    {
        SportTypeModel::create([
            'name' => $requestData['name']
        ]);

        $this->redirect('/sport-types/create');
    }

    public function delete(array $requestData): void
    {
        SportTypeModel::delete($requestData['id']);

        $this->redirect('/sport-types/create');
    }
}