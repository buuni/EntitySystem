<?php
return [
	'settings' => [
		'displayErrorDetails' => true, // set to false in production

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
