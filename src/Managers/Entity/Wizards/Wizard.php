<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Pimple\Container;

abstract class Wizard {
	/**
	 * @var \Entity\Container
	 */
	protected $container;

	public function __construct(Container $container) {
		$this->container = $container;
	}
}