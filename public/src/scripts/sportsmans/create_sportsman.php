<?php

require_once __DIR__ . '/../../db/idiorm_init.php';
require_once __DIR__ . '/../utilities/prepare_string.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportsmanToInsert = [];

    if (isset($_POST['name']) && prepareSting($_POST['name'])) {
        $sportsmanToInsert['name'] = $_POST['name'];

        ORM::forTable('sportsmans')->create($sportsmanToInsert)->save();
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}