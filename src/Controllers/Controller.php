<?php
/**
 * Author: Demko Igor
 */

namespace Controllers;


use Helpers\DatabaseEntityMigration;
use Helpers\LoggerEntityMigration;
use Interop\Container\ContainerInterface;
use \Entity\Entity;

abstract class Controller {
	/**
	 * @var ContainerInterface
	 */
	protected $ci;

	/**
	 * @var Entity
	 */
	protected $entity;

	public function __construct(ContainerInterface $ci) {
		$this->ci = $ci;

		$settings = [
			'settings' => [
				'debug' => $this->ci->get('settings')['displayErrorDetails'], // Set to false in production mode
			],

			// Default services

			'connect' => function() {
				return new DatabaseEntityMigration($this->ci->connect);
			},

			'logger' => function() {
				return new LoggerEntityMigration($this->ci->logger);
			}
		];

		$this->entity = new Entity($settings);
	}
}