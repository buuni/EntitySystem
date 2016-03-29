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
	$logger = null;

	if (!empty($settings)) {
		foreach($settings as $loggerName => $handlers) {
			$logger = new Monolog\Logger($settings['name']);
			foreach ($handlers as $handler) {
				$logger->pushProcessor(new Monolog\Processor\UidProcessor());
				$logger->pushHandler(new Monolog\Handler\StreamHandler($handler['path'], $handler['level']));
			}
		}
	}

	return $logger;
};
