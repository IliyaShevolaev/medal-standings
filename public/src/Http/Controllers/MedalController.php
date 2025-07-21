<?php

namespace App\Http\Controllers;

use App\classes\MVC\View;
use App\classes\MVC\Controller;
use App\models\CountryModel;
use App\models\MedalModel;
use App\models\MedalsSportsmansModel;
use App\models\SportsmanModel;
use App\models\SportTypeModel;
use ORM;
require_once __DIR__ . '/../../scripts/medals/sort_medals.php';

class MedalController extends Controller
{
    public function index(array $requestData): void
    {
        $medalsByCountry = ORM::for_table('medals')
            ->select('countries.id', 'country_id')
            ->select('countries.name', 'name')
            ->selectExpr('COALESCE(SUM(medals.type = "gold"), 0)', 'gold')
            ->selectExpr('COALESCE(SUM(medals.type = "silver"), 0)', 'silver')
            ->selectExpr('COALESCE(SUM(medals.type = "bronze"), 0)', 'bronze')
            ->selectExpr('COUNT(medals.type)', 'total')
            ->rightOuterJoin('countries', ['medals.country_id', '=', 'countries.id'])
            ->groupBy('countries.name')
            ->groupBy('countries.id')
            ->findArray();

        $asc = false;

        if (isset($requestData['asc'])) {
            $asc = !$requestData['asc'];
        }

        if (isset($requestData['sort_key'])) {
            columnSort($medalsByCountry, $_GET['sort_key'], $asc);
        } else {
            defaultSort($medalsByCountry, $asc);
        }

        View::make('medals/show_table.tpl', [
            'asc' => $asc,
            'medalsByCountry' => $medalsByCountry,
        ]);
    }

    public function show(array $requestData): void
    {
        $medalTypeHeader = '';

        switch ($requestData['medal']) {
            case 'gold':
                $medalTypeHeader = 'золотые';
                break;
            case 'silver':
                $medalTypeHeader = 'серебряные';
                break;
            case 'bronze':
                $medalTypeHeader = 'бронзовые';
                break;
        }

        $selectedCountry = $requestData['country'];
        if (!ctype_digit($selectedCountry)) {
            $selectedCountry = 0;
        }

        $selectedCountryName = CountryModel::find($selectedCountry)->name;

        $selectedMedalType = $requestData['medal'];

        $medalsByCountryAndType = ORM::forTable('medals')
            ->select('medals.id', 'medal_id')
            ->select('sportsmans.name', 'sportsman_name')
            ->select('sport_types.name', 'sport_type_name')
            ->leftOuterJoin('sport_types', ['medals.sport_type_id', '=', 'sport_types.id'])
            ->leftOuterJoin('medals_sportsmans', ['medals.id', '=', 'medals_sportsmans.medal_id'])
            ->leftOuterJoin('sportsmans', ['sportsmans.id', '=', 'medals_sportsmans.sportsman_id'])
            ->where('medals.type', $selectedMedalType)
            ->where('medals.country_id', $selectedCountry)
            ->findArray();

        $medalsRow = [];
        foreach ($medalsByCountryAndType as $record) {
            if (isset($medalsRow[$record['medal_id']])) {
                $medalsRow[$record['medal_id']]['name'] .= ', ' . $record['sportsman_name'];
            } else {
                $medalsRow[$record['medal_id']] = [
                    'name' => $record['sportsman_name'],
                    'sport_type' => $record['sport_type_name']
                ];
            }
        }

        $header = [
            'medal' => $medalTypeHeader,
            'country' => $selectedCountryName,
        ];

        View::make('medals/show.tpl', [
            'header' => $header,
            'medalsRow' => $medalsRow
        ]);
    }

    public function create(): void
    {
        $countries = CountryModel::all();
        $sportTypes = SportTypeModel::all();
        $sportsmans = SportsmanModel::all();

        View::make("medals/add.tpl", [
            'countries' => $countries,
            'sportTypes' => $sportTypes,
            'sportsmans' => $sportsmans,
        ]);
    }

    public function store(array $requestData): void
    {
        $medalToInsert = [];
        $medalToInsert['type'] = $requestData['type'];
        $medalToInsert['sport_type_id'] = $requestData['sport_type_id'];
        $medalToInsert['country_id'] = $requestData['country_id'];

        $currentMedal = MedalModel::create($medalToInsert);

        foreach ($_POST['sportsmans_id'] as $sportsmanId) {
            $medalSportsmansToInsert = [];
            $medalSportsmansToInsert['medal_id'] = $currentMedal->id();
            $medalSportsmansToInsert['sportsman_id'] = $sportsmanId;

            MedalsSportsmansModel::create($medalSportsmansToInsert);
        }

        $this->redirect('/');
    }
}