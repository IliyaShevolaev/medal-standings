<?php

require_once __DIR__ . '/../../db/idiorm_init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportTypeToInsert = [];

    if (isset($_POST['name']) && $_POST['name'] != '') {
        $sportTypeToInsert['name'] = $_POST['name'];
        
        ORM::forTable('sport_types')->create($sportTypeToInsert)->save();
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}