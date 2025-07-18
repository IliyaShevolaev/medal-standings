<?php
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$sportTypes = ORM::forTable('sport_types')->findArray();

$smarty->assign(compact('sportTypes'));
$smarty->display("sport_types/add.tpl");

?>