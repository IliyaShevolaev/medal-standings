<?php

return [
    ['GET', '/countries', 'CountryController', 'index'],
    ['POST', '/countries/create', 'CountryController', 'create'],
    ['POST', '/countries/delete', 'CountryController', 'delete'],

    ['GET', '/', 'MedalController', 'index'],
    ['GET', '/medal/show', 'MedalController', 'show'],
    ['POST', '/medal/create', 'MedalController', 'create'],

    ['GET', '/new', 'TestController', 'new', 'new.index'],
];