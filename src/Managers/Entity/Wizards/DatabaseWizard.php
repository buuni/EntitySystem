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

	/** @var SchemaWizard */
	protected $wSchema;

	protected $prefix;

	public function __construct(Container $ci) {
		parent::__construct($ci);
		$type = array_keys($ci['settings']['driver'])[0];
		$this->driver = DatabaseFactory::create($ci, $type);

		$this->wSql = $ci->get('SqlWizard');
		$this->wSchema = $ci->get('SchemaWizard');
		$this->prefix = $ci->get('settings')['tables']['prefix'];
	}

	public function query($sql, $prepare = []) {
		$result = $this->driver->prepare($sql);
		$result->execute($prepare);
		return $result->fetchAll();
	}

	public function createTable(TableStatement $statement) {
		$sql = $this->wSql->createTable($this->prefix . $statement->getName(), $statement->getColumns(), ['primary' => $statement->getPrimary()]);
		$this->query($sql);
	}

	public function alterTable(TableStatement $statement) {
		if(!empty($compare = $this->wSchema->compare($statement))) {
			$sql = '';
			if(isset($compare['create'])) {
				foreach($compare['create'] as $column) {
//					var_dump($column);die;
					$sql .= $this->wSql->alterNewColumnTable($this->prefix . $statement->getName(), $column);
//					var_dump($sql);die;
					$this->query($sql);die;
				}
			}
		}

	}

}