<?php

require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$countries = ORM::forTable('countries')->findArray();

$smarty->assign([
    'path' => 'countries/add.tpl',
    'countries' => $countries
]);
$smarty->display("layouts/main.tpl");

?>