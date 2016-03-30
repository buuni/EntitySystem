<?php
/**
 * Author: Demko Igor
 */

$app->group('/entity', function() {
	$this->get('/add-dictionary', 'App\Controllers\EntityManager:addDictionary');
});