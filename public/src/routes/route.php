<?php



return [
    // GET
    ['GET', '/', 'TestController', 'test', 'testname'],
    ['GET', '/countries', 'CountryController', 'index', 'country.index'],
    ['POST', '/countries/create', 'CountryController', 'create', 'country.create'],
    ['POST', '/countries/delete', 'CountryController', 'delete', 'country.delete'],
    ['GET', '/new', 'TestController', 'new', 'new.index'],
];