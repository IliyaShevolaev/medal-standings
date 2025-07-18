<?php

require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../scripts/get_name.php';

// SELECT
// medals.id as medal_id, sportsmans.name AS sportsman_name, sport_types.name as sport_type_name
// FROM medals 
// JOIN sport_types ON medals.sport_type_id = sport_types.id
// JOIN medals_sportsmans ON medals.id = medals_sportsmans.medal_id
// JOIN sportsmans ON sportsmans.id = medals_sportsmans.sportsman_id
// WHERE medals.type = 'gold' AND medals.country_id = 1;

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

    $medalRow = [];
    foreach ($medalsByCountryAndType as $record) {
        if (isset($medalRow[$record['medal_id']])) {
            $medalRow[$record['medal_id']]['name'] .= ', ' . $record['sportsman_name'];
        } else {
            $medalRow[$record['medal_id']] = [
                'name' => $record['sportsman_name'],
                'sport_type' => $record['sport_type_name']
            ];
        }
    }
}
?>

<div class="main-container d-flex flex-column justify-content-center align-items-center">
    <h1><?= $selectedCountryName . ', ' . $selectedMedalType ?> медали</h1>
    <?php
    foreach ($medalRow as $row) {
        echo '<p> ' . htmlspecialchars($row['name'] ?? '') . ' — ' . htmlspecialchars($row['sport_type']) . '</p>';
    }
    ?>
</div>

<?php
require_once __DIR__ . '/../scripts/footer.php';
?>