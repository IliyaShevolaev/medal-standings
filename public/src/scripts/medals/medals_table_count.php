<?php

require_once __DIR__ . '/../../db/idiorm_init.php';

// SELECT 
// countries.id, countries.name as name, SUM(medals.type = 'gold') as 'gold', SUM(medals.type = 'silver') as 'silver', SUM(medals.type = 'bronze') as 'bronze', COUNT(medals.type)
// FROM `medals` 
// RIGHT JOIN countries on medals.country_id = countries.id
// GROUP BY countries.name, countries.id;

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
