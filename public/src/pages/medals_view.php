<?php

require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $medalTypeHeader = '';

    switch ($_GET['medal']) {
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

    $selectedCountry = $_GET['country'];
    if (!ctype_digit($selectedCountry)) {
        $selectedCountry = 0;
    }

    $selectedCountryName = ORM::forTable('countries')->find_one($selectedCountry)->name;

    $selectedMedalType = $_GET['medal'];

    // SELECT
    // medals.id as medal_id, sportsmans.name AS sportsman_name, sport_types.name as sport_type_name
    // FROM medals 
    // JOIN sport_types ON medals.sport_type_id = sport_types.id
    // JOIN medals_sportsmans ON medals.id = medals_sportsmans.medal_id
    // JOIN sportsmans ON sportsmans.id = medals_sportsmans.sportsman_id
    // WHERE medals.type = 'gold' AND medals.country_id = 1;

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

    $smarty->assign(compact('header'));
    $smarty->assign(compact('medalsRow'));
    $smarty->assign([
        'path' => 'medals/show.tpl',
        'header' => $header,
        'medalsRow' => $medalsRow,
    ]);
    $smarty->display('layouts/main.tpl');

}
?>