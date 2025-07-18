<?php

require_once __DIR__ . '/../../../../../vendor/autoload.php';

use Smarty\Smarty;

$baseDir = dirname(__DIR__);

$smarty = new Smarty();

$smarty->setConfigDir($baseDir . '/config');
$smarty->setCompileDir($baseDir . '/templates_c');
$smarty->setCacheDir($baseDir . '/cache');
$smarty->setTemplateDir(dirname(__DIR__, 2) . '/views');
