<?php

namespace App\Classes\MVC;

use Smarty\Smarty;

class View
{
    private static $templateEngineDir;
    private static $templateEngine;

    private static function initConfig()
    {
        $config = require_once __DIR__ . '/../../config/template_engine.php';
        self::$templateEngineDir = $config['base_dir'];
    }

    private static function initTemplateEngine()
    {
        self::initConfig();

        $baseDir = self::$templateEngineDir;

        self::$templateEngine = new Smarty();

        self::$templateEngine->setConfigDir($baseDir . '/template_engine/Smarty/config');
        self::$templateEngine->setCompileDir($baseDir . '/template_engine/Smarty/templates_c');
        self::$templateEngine->setCacheDir($baseDir . '/template_engine/Smarty/cache');
        self::$templateEngine->setTemplateDir($baseDir . '/views');
    }

    public static function make(string $templatePath, array $assignData): void
    {
        self::initTemplateEngine();

        $assignData['path'] = $templatePath;

        self::$templateEngine->assign($assignData);
        self::$templateEngine->display('layouts/main.tpl');
    }
}