<?php 

require_once __DIR__ . '/Model.php';

$countries = new Model('countries', ['id', 'name']);
$sportTypes = new Model('sport_types', ['id', 'name']);
$sportsmans = new Model('sportsmans', ['id', 'name']);
$medals = new Model('medals', ['id', 'type', 'sport_type_id', 'country_id']);

$medalsSportsmans = new Model('medals_sportsmans', ['id', 'medal_id', 'sportsman_id']);

// CREATE TABLE IF NOT EXISTS medals ( id INT AUTO_INCREMENT PRIMARY KEY, type VARCHAR(255) NOT NULL, sport_type_id INT NOT NULL, FOREIGN KEY (sport_type_id) REFERENCES sport_types(id) ) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

// адаптивность 