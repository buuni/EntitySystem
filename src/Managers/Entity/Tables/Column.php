<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Tables;


class Column {

	protected $name;

	protected $type;

	protected $length;

	protected $options = [
		'auto_increment' => false,
		'comment' => null,
	];

	protected $keys = [
		'primary' => false,
	];

	public function __construct($name, $type, $length, $options = []) {
		$this->name = $name;
		$this->type = $type;
		$this->length = $length;
		$this->options += $options;
	}

	public function setPrimaryKey($value) {
		$this->keys['primary'] = $value;
	}
	public function setAutoIncrement($value) {
		$this->options['auto_increment'] = $value;
	}

	/**
	 * Getter name.
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Getter type.
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Getter length.
	 * @return mixed
	 */
	public function getLength() {
		return $this->length;
	}

	public function primary() {
		return $this->keys['primary'];
	}

	public function autoIncrement() {
		return $this->options['auto_increment'];
	}

	/**
	 * Getter options.
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Getter keys.
	 * @return array
	 */
	public function getKeys() {
		return $this->keys;
	}



}