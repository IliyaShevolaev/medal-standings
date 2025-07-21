<?php



return [
    // GET
    ['GET', '/', 'TestController', 'test', 'testname'],
    ['GET', '/countries', 'CountryController', 'index', 'country.index'],
    ['GET', '/new', 'TestController', 'new', 'new.index'],
];