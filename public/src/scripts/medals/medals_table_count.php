<?php

require_once __DIR__ . '/../../db/idiorm_init.php';
require_once __DIR__ . '/../../scripts/get_name.php';

$allMedals = ORM::forTable('medals')->findArray();
$allCountries = ORM::forTable('countries')->findArray();

$medalsByCountry = [];

foreach ($allMedals as $medal) {
    $countryId = $medal['country_id'];

    if (!isset($medalsByCountry[$countryId])) {
        $medalsByCountry[$countryId] = [
            'gold' => 0,
            'silver' => 0,
            'bronze' => 0,
            'total' => 0
        ];
    }

    switch ($medal['type']) {
        case 'gold':
            $medalsByCountry[$countryId]['gold']++;
            break;
        case 'silver':
            $medalsByCountry[$countryId]['silver']++;
            break;
        case 'bronze':
            $medalsByCountry[$countryId]['bronze']++;
            break;
    }

    $medalsByCountry[$countryId]['total']++;
    $medalsByCountry[$countryId]['name'] = getNameById($allCountries, $countryId);
}

foreach ($allCountries as $country) {
    if (!key_exists($country['id'], $medalsByCountry)) {
        $medalsByCountry[$country['id']] = [
            'gold' => 0,
            'silver' => 0,
            'bronze' => 0,
            'total' => 0
        ];

        $medalsByCountry[$country['id']]['name'] = getNameById($allCountries, $country['id']);
    }
}

