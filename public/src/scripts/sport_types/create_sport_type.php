<?php

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportTypeToInsert = [];

    if (isset($_POST['name']) && $_POST['name'] != '') {
        $sportTypeToInsert[] = $_POST['name'];
        $sportTypes->insert($sportTypeToInsert);
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}