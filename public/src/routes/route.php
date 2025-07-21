<?php

return [
    'countries' => [
        ['GET', '/countries/create', 'CountryController', 'create'],
        ['POST', '/countries/store', 'CountryController', 'store'],
        ['POST', '/countries/delete', 'CountryController', 'delete'],
    ],

    'sportsmans' => [
        ['GET', '/sportsmans/create', 'SportsmanController', 'create'],
        ['POST', '/sportsmans/store', 'SportsmanController', 'store'],
        ['POST', '/sportsmans/delete', 'SportsmanController', 'delete'],
    ],

    'sport-types' => [
        ['GET', '/sport-types/create', 'SportTypeController', 'create'],
        ['POST', '/sport-types/store', 'SportTypeController', 'store'],
        ['POST', '/sport-types/delete', 'SportTypeController', 'delete'],
    ],

    'medal' => [
        ['GET', '/medal', 'MedalController', 'index'],
        ['GET', '/medal/show', 'MedalController', 'show'],
        ['GET', '/medal/create', 'MedalController', 'create'],
        ['POST', '/medal/store', 'MedalController', 'store'],
    ],
];