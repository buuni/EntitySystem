<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Statements;


use Entity\Container;

abstract class Statement {
	/** @var Container */
	protected $ci;

	public function __construct(Container $ci) {
		$this->ci = $ci;
	}

}