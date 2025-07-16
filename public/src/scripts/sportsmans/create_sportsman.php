<?php

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportsmanToInsert = [];

    if (isset($_POST['name']) && $_POST['name'] != '') {
        $sportsmanToInsert[] = "'" . $_POST['name'] . "'";
        $sportsmans->insert($sportsmanToInsert);
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}