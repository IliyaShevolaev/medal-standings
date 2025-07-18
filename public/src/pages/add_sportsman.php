<?php
require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$sportsmans = ORM::forTable('sportsmans')->findArray();

$smarty->assign(compact('sportsmans'));
$smarty->display("sportsmans/add.tpl");

?>