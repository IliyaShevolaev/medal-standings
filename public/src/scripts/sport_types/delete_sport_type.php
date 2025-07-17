<?php

require_once __DIR__ . '/../../db/idiorm_init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ORM::forTable('sport_types')->find_one($_POST['id'])->delete();

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}