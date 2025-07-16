<?php 

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medalToInsert = [];
    $medalToInsert[] = "'" . $_POST['type'] . "'";
    $medalToInsert[] = $_POST['sport_type_id'];
    $medalToInsert[] = $_POST['country_id'];

    $currentMedalId = $medals->insert($medalToInsert);
    
    var_dump($_POST['sportsmans_id']);
    echo '<br>';
    var_dump($currentMedalId);

    foreach ($_POST['sportsmans_id'] as $sportsmanId) {
        $medalSportsmansToInsert = [];
        $medalSportsmansToInsert[] = $currentMedalId;
        $medalSportsmansToInsert[] = $sportsmanId;

        $medalsSportsmans->insert($medalSportsmansToInsert);
    }

    header("Location: " . '/');
    exit;
}