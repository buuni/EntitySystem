<?php
/**
 * Author: Demko Igor
 */

namespace App\Helpers;


use \Entity\Interfaces\DatabaseInterface;
use \Slim\PDO\Database;

/**
 * Class DatabaseEntityMigration
 * Класс миграции для менеджера сущностей.
 * @package Helpers
 */
class DatabaseEntityMigration implements DatabaseInterface {

	/**
	 * @var Database
	 */
	protected $driver;

	public function __construct(Database $database) {
		$this->driver = $database;
	}

	public function select($columns = ['*']) {
		$this->driver->select($columns);
	}

	public function insert($columns = []) {
		$this->driver->insert($columns);
	}

	public function update($pairs = []) {
		$this->driver->update($pairs);
	}

	public function delete($table = null) {
		$this->driver->delete($table);
	}

	public function query($sql = null) {
		$this->driver->query($sql);
	}

}