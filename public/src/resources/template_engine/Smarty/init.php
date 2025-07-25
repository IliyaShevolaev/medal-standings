<?php

use Smarty\Smarty;

$baseDir = dirname(__DIR__);

$smarty = new Smarty();

$smarty->setConfigDir($baseDir . '/Smarty/config');
$smarty->setCompileDir($baseDir . '/Smarty/templates_c');
$smarty->setCacheDir($baseDir . '/Smarty/cache');
$smarty->setTemplateDir(dirname(__DIR__, 2) . '/views');
