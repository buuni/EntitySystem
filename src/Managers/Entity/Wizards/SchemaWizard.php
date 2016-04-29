<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\Statements\TableStatement;
use Entity\Tables\Column;

class SchemaWizard extends Wizard {

	protected $schemaFile;

	protected $schema = [
		'tables' => []
	];

	public function __construct(Container $ci) {
		parent::__construct($ci);

		$schemaFile = fopen(__DIR__ . '/../schema.json', 'a+');
	}

	public function addTable(TableStatement $table) {
		$tablePrepare = [];

		/** @var Column $column */
		foreach($table->getColumns() as $column) {
			$tablePrepare[$table->getName()][] = [
				'name' => $column->getName(),
				'type' => $column->getType(),
				'length' => $column->getLength(),
				'options' => $column->getOptions(),
				'keys' => $column->getKeys()
			];
		}

		$this->schema['tables'] += $tablePrepare;

		var_dump($this->schema);die;
	}

}