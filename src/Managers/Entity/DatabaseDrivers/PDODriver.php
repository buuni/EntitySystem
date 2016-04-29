<?php
/**
 * Author: Demko Igor
 */

namespace Entity\DatabaseDrivers;

use Entity\Container;

class PDODriver extends DatabaseDriver {

	/** @var \PDO */
	protected $connect;

	public function __construct(Container $ci) {
		$data = $ci['settings']['driver']['PDO'];
		$dsn = 'mysql:host=' . $data['host'] . ';dbname=' . $data['database'] . ';charset=' . $data['charset'];

		$options = array(
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES => false,
			//\PDO::ATTR_STATEMENT_CLASS => array('Entity\\Statements\\QueryStatement', array($this->ci)),
		);

		$this->connect = new \PDO($dsn, $data['user'], $data['password'], $options);
	}

	public function __call($name, $arguments) {
		return call_user_func_array([$this->connect, $name], $arguments);
	}

}