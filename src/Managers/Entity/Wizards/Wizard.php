<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Collection;
use Entity\Container;

abstract class Wizard {

	/** @var Container */
	protected $ci;

	/** @var  Collection */
	protected $settings;

	public function __construct(Container $ci) {
		$this->ci = $ci;
		$this->settings = $ci->get('settings');
	}
}