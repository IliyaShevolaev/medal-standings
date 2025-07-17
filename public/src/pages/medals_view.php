<?php

require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../scripts/get_name.php';

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

    $selectedMedalType = $_GET['medal'];

    $sportsmansRecords = ORM::forTable('sportsmans')->findArray();
    $sportTypeRecords = ORM::forTable('sport_types')->findArray();

    $params = ['is', [$selectedMedalType, $selectedCountry]];
    $medalsByCountryAndType = ORM::forTable('medals')->where('type', $selectedMedalType)->where('country_id', $selectedCountry)->findArray();
}
?>

<div class="d-flex flex-column justify-content-center align-items-center"
    style="padding-left: 10rem; padding-right: 10rem;">
    <h1><?= htmlspecialchars(getNameById(ORM::forTable('countries')->findArray(), $selectedCountry)) . ', ' . $medalTypeHeader ?> медали</h1>
    <?php
    foreach ($medalsByCountryAndType as $record) {
        $sportsmansWithSelectedMedals = ORM::forTable('medals_sportsmans')->where('medal_id', $record['id'])->findArray();

        $currentSportsmans = [];

        foreach ($sportsmansWithSelectedMedals as $currentMedalRecord) {
            $currentSportsmans[] = getNameById($sportsmansRecords, $currentMedalRecord['sportsman_id']);
        }

        $sportsmansString = implode(', ', $currentSportsmans);
        $sportType = getNameById($sportTypeRecords, $record['sport_type_id']);

        echo '<p> ' . htmlspecialchars($sportsmansString) . ' — ' . htmlspecialchars($sportType) . '</p>';
    }
    ?>
</div>

<?php
require_once __DIR__ . '/../scripts/footer.php';
?>