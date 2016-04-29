<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\DatabaseDrivers\DatabaseFactory;
use Entity\Statements\TableStatement;

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

	public function query($sql, $prepare = []) {
		$result = $this->driver->prepare($sql);
		$result->execute($prepare);
		return $result->fetchAll();
	}

	public function createTable(TableStatement $statement) {
//		var_dump($statement);
		$wSchema = $this->ci->get('SchemaWizard');
		$wSchema->addTable($statement);

		$sql = $this->wSql->createTable($statement->getName(), $statement->getColumns(), ['primary' => $statement->getPrimary()]);
//		var_dump($sql);die;
		$this->query($sql);
	}

}