<?php 

require_once __DIR__ . '/Model.php';

$countries = new Model('countries', ['id', 'name']);
$sportTypes = new Model('sport_types', ['id', 'name']);
$sportsmans = new Model('sportsmans', ['id', 'name']);