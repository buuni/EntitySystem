<?php
return [
	'settings' => [
		'displayErrorDetails' => true, // set to false in production

		// Настройка соединения с базой
		'db' => [
			'host' => '127.0.0.1',
			'dbname' => 'entity',
			'user' => 'root',
			'password' => '',
			'charset' => 'utf8'
		],

		// Каталог с шаблонами
		'renderer' => [
			'template_path' => __DIR__ . '/../templates/',
		],

		// Настройка логера Monolog
		'logger' => [
			'name' => 'application',
			'path' => __DIR__ . '/../logs/debug.log',
		],
	],
];
