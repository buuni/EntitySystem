<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;

abstract class Wizard {

	/** @var Container */
	protected $ci;

	public function __construct(Container $ci) {
		$this->ci = $ci;
	}
}