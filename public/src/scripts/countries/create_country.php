<?php 

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $countryToInsert = [];

    if (isset($_POST['name']) && $_POST['name'] !== '') {
        $countryToInsert[] = $_POST['name'];
        $countries->insert($countryToInsert);
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}