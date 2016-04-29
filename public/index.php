<?php

ini_set("display_errors",1);
error_reporting(E_ALL);

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

$a = require __DIR__ . '/../vendor/autoload.php';

session_start();

// Настройки приложения
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);


// Установка зависимостей
require __DIR__ . '/../src/dependencies.php';

// Подключение посредников
require __DIR__ . '/../src/Middleware/middleware.php';

// Регистрация роутов
require __DIR__ . '/../src/Routs/routes.php';

// Запуск приложения
$app->run();
