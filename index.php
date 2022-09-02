<?php

// FRONT CONTROLLER

// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__)); //определяем константу ROOT "C:\wamp64\www"
require_once(ROOT.'/components/Autoload.php');

// Вызов Router
$router = new Router();
$router->run();