<?php

namespace App\Http\Controllers;

use App\Classes\MVC\Controller;
use App\Classes\MVC\View;
use App\models\SportsmanModel;

class SportsmanController extends Controller
{
    public function create(): void
    {
        $sportsmans = SportsmanModel::all();
        
        View::make('sportsmans/add.tpl', [
            'sportsmans' => $sportsmans
        ]);
    }

    public function store(array $requestData): void
    {
        SportsmanModel::create([
            'name' => $requestData['name']
        ]);

        $this->redirect('/sportsmans/create');
    }

    public function delete(array $requestData): void
    {
        SportsmanModel::delete($requestData['id']);

        $this->redirect('/sportsmans/create');
    }
}