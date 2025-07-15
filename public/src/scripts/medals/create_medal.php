<?php 

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medalToInsert = [];
    $medalToInsert[] = "'" . $_POST['type'] . "'";
    $medalToInsert[] = $_POST['sport_type_id'];

    var_dump($medalToInsert);

    $medalSportsmansToInsert = [];
    //$medalSportsmansToInsert[] = $_POST['sport_type_id'];
    $medalSportsmansToInsert[] = $_POST['sportsmans_id'];

    echo '<br>';
    var_dump($medalSportsmansToInsert);

    //вставка отдельно в медали отдельно в медали_спотсмены (тут циклом)

    //$sportTypes->insert($sportTypeToInsert);

    //header("Location: " . $_SERVER['HTTP_REFERER']);
    //exit;
}