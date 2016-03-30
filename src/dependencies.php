<?php

// DIC configuration
$container = $app->getContainer();

// Render
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));

    return $logger;
};

// PDO драйвер
$container['connect'] = function ($c) {
    $settings = $c->get('settings')['db'];

    $dsn = 'mysql:host=' . $settings['host'] . ';dbname=' . $settings['dbname'] . ';charset=' . $settings['charset'];

    try {
        $connect = new Slim\PDO\Database($dsn, $settings['user'], $settings['password']);
    } catch (\PDOException $e) {
        if ($c->get('settings')['displayErrorDetails'] === true) {
            $c->logger->debug('error connect');
        }

        $c->logger->error('error connect');
        echo 'Connect error';
    }

    return $connect;
};
