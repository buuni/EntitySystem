<?php
/**
 * Author: Demko Igor
 */

/*spl_autoload_register(function($class) {
	// Для того, чтобы использовать красивые неймспейсы. Вместо src/Controllers будет Controllers
	$patterns = array(
		'Controllers' => 'src/Controllers',
		'Helpers' => 'src/Helpers',
		//'Entity' => 'src/Managers/EntityManager',
		//'Entity\Interfaces' => 'src/Managers/EntityManager/Interfaces',
		//'Entity\Exception' => 'src/Managers/EntityManager/Exception',
	);

	$parts = explode('\\', $class);
	$classname = $parts[count($parts) - 1];
	unset($parts[count($parts) - 1]);

	foreach($patterns as $tempPattern => $path) {
		$partsPattern = explode('\\', $tempPattern);
		$diff = array_diff_assoc($parts, $partsPattern);

		if(empty($diff)) {
			$lower = mb_strtolower($classname);
			$path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path . '/';

			if(is_file($path . $classname . '.php')) {
				$variant = $classname;
			} elseif(is_file($path . $lower . '.php')) {
				$variant = $lower;
			} else return;

			require_once $path . $variant . '.php';
		}
	}
});*/