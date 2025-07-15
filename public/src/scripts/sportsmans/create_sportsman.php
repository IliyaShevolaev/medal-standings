<?php 

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $countryToInsert = [];
    $countryToInsert[] = "'" . $_POST['name'] . "'";
    $sportsmans->insert($countryToInsert);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}