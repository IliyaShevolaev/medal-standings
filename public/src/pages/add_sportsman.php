<?php
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$sportsmans = ORM::forTable('sportsmans')->findArray();

$smarty->assign([
    'path' => 'sportsmans/add.tpl',
    'sportsmans' => $sportsmans
]);
$smarty->display("layouts/main.tpl");

?>