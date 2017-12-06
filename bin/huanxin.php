#!/usr/bin/env php

<?php

use Symfony\Component\Console\Application;

if (PHP_SAPI != 'cli') {
    die('请使用cli模式运行');
}

define('ROOT_DIR', realpath(__DIR__ . '/../'));
define('RUNTIME_PATH', sys_get_temp_dir() . '/jmruntime/');
define('IS_CLI', true);
// echo RUNTIME_PATH;

$loader = ROOT_DIR . '/vendor/autoload.php';
if (!file_exists($loader)) {
    die(
        'You must set up the project dependencies, run the following commands:' . PHP_EOL .
        'curl -s http://getcomposer.org/installer | php' . PHP_EOL .
        'php composer.phar install' . PHP_EOL
    );
}

$loader = require $loader;

// 加载配置文件

$app = new Application();
$app->run();
