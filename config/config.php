<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Sarajevo');

session_start();
define("ROOT_PATH", substr(__DIR__, 0, -6));
define("BASE_URL", 'http://localhost/projekti/php-setup-vendor/');
require_once ROOT_PATH . 'vendor/autoload.php';
