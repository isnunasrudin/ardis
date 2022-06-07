<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . '_bootstrap.php');

$app = new Aplikasi();
$app->run();

var_dump($_SESSION);