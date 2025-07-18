<?php
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$sportTypes = ORM::forTable('sport_types')->findArray();

$smarty->assign([
    'path' => 'sport_types/add.tpl',
    'sportTypes' => $sportTypes
]);
$smarty->display("layouts/main.tpl");

?>