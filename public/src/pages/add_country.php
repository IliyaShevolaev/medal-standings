<?php

require_once __DIR__ . '/../db/idiorm_init.php';
require_once __DIR__ . '/../resources/template_engine/Smarty/init.php';

$countries = ORM::forTable('countries')->findArray();

$smarty->assign(compact('countries'));
$smarty->display("countries/add.tpl");

?>