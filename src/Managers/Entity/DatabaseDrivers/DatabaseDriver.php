<?php
/**
 * Author: Demko Igor
 */

namespace Entity\DatabaseDrivers;


use Entity\Container;

abstract class DatabaseDriver {
	/** @var Container */
	protected $ci;

	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

}