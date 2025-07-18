<?php 

require_once __DIR__ . '/../../db/idiorm_init.php';
require_once __DIR__ . '/../utilities/prepare_string.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $countryToInsert = [];

    if (isset($_POST['name']) && prepareSting($_POST['name'])) {
        $countryToInsert['name'] = $_POST['name'];
        
        ORM::forTable('countries')->create($countryToInsert)->save();
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}