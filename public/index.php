<?php

$GLOBALS['startime'] = microtime(true);

require_once(
    __DIR__ . DIRECTORY_SEPARATOR .
    '..' . DIRECTORY_SEPARATOR .
    'core' . DIRECTORY_SEPARATOR .
    '_bootstrap.php'
);

$app = new Aplikasi();
$app->run();