<?php
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$countries = ORM::forTable('countries')->findArray();
$sportTypes = ORM::forTable('sport_types')->findArray();
$sportsmans = ORM::forTable('sportsmans')->findArray();

$smarty->assign([
    'path' => 'medals/add.tpl',
    'countries' => $countries,
    'sportTypes' => $sportTypes,
    'sportsmans' => $sportsmans,
]);
$smarty->display("layouts/main.tpl");

?>