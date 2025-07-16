<?php

require_once __DIR__ . '/../../db/init_models.php';
require_once __DIR__ . '/../../scripts/get_name.php';

$allMedals = $medals->all();
$countryNames = $countries->all();

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
    $medalsByCountry[$countryId]['name'] = getNameById($countryNames, $countryId);
}

