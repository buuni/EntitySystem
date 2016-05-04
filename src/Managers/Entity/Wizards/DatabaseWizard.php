<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\DatabaseDrivers\DatabaseFactory;
use Entity\Interfaces\TableInterface;
use Entity\Statements\TableStatement;
use Entity\Tables\Table;

class DatabaseWizard extends Wizard {

	/** @var \Entity\DatabaseDrivers\DatabaseDriver */
	protected $driver;

	/** @var SqlWizard */
	protected $wSql;

	public function __construct(Container $ci) {
		parent::__construct($ci);
		$type = array_keys($ci['settings']['driver'])[0];
		$this->driver = DatabaseFactory::create($ci, $type);

		$this->wSql = $ci->get('SqlWizard');
	}

	public function getAllTables() {
		return $this->query('SHOW TABLES');
	}

	public function query($sql, $prepare = []) {
		$result = $this->driver->prepare($sql);
		$result->execute($prepare);
		return $result->fetchAll();
	}

	public function createTable(TableInterface $table) {
		$sql = $this->wSql->createTable($table);
		$this->query($sql);
	}

	public function alterTable(TableInterface $table) {
		$sql = $this->wSql->alterTable($table);
		$this->query($sql);

	}

	public function getDBName() {
		return $this->driver->getDBName();
	}

}