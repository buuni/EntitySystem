<?php
/**
 * Author: Demko Igor
 */

$app->get('/', function ($request, $response, $args) {

	// Render index view
	return $this->renderer->render($response, 'index.phtml', $args);
});