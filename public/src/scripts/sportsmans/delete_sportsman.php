<?php

require_once __DIR__ . '/../../db/init_models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sportsmans->delete((int)$_POST['id']);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}