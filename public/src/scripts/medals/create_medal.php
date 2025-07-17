<?php 

require_once __DIR__ . '/../../db/idiorm_init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medalToInsert = [];
    $medalToInsert['type'] = $_POST['type'];
    $medalToInsert['sport_type_id'] = $_POST['sport_type_id'];
    $medalToInsert['country_id'] = $_POST['country_id'];

    $currentMedal = ORM::forTable('medals')->create($medalToInsert);
    $currentMedal->save();

    foreach ($_POST['sportsmans_id'] as $sportsmanId) {
        $medalSportsmansToInsert = [];
        $medalSportsmansToInsert['medal_id'] = $currentMedal->id();
        $medalSportsmansToInsert['sportsman_id'] = $sportsmanId;

        ORM::forTable('medals_sportsmans')->create($medalSportsmansToInsert)->save();
    }

    header("Location: " . '/');
    exit;
}