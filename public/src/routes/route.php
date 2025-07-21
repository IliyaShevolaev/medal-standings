<?php

return [
    ['GET', '/countries/create', 'CountryController', 'create'],
    ['POST', '/countries/store', 'CountryController', 'store'],
    ['POST', '/countries/delete', 'CountryController', 'delete'],

    ['GET', '/sportsmans/create', 'SportsmanController', 'create'],
    ['POST', '/sportsmans/store', 'SportsmanController', 'store'],
    ['POST', '/sportsmans/delete', 'SportsmanController', 'delete'],

    ['GET', '/sport_types/create', 'SportTypeController', 'create'],
    ['POST', '/sport_types/store', 'SportTypeController', 'store'],
    ['POST', '/sport_types/delete', 'SportTypeController', 'delete'],

    ['GET', '/', 'MedalController', 'index'],
    ['GET', '/medal/show', 'MedalController', 'show'],
    ['GET', '/medal/create', 'MedalController', 'create'],
    ['POST', '/medal/store', 'MedalController', 'store'],
];