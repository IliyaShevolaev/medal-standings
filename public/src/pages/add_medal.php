<?php
require_once __DIR__ . '/../scripts/header.php';
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$countries = ORM::forTable('countries')->findArray();
$sportTypes = ORM::forTable('sport_types')->findArray();
$sportsmans = ORM::forTable('sportsmans')->findArray();

$smarty->assign(compact('countries'));
$smarty->assign(compact('sportTypes'));
$smarty->assign(compact('sportsmans'));
$smarty->display('medals/add.tpl');

require_once __DIR__ . '/../scripts/footer.php';
?>