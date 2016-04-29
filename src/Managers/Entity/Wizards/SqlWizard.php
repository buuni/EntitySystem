<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\Tables\Column;

class SqlWizard extends Wizard {

	public function __construct(Container $ci) {
		parent::__construct($ci);
	}

	public function createTable($name, $columns, $keys = []) {
		$columnSql = '';

		/** @var Column $column */
		foreach($columns as $column) {
			$autoIncrement = $column->autoIncrement() == true ? 'NOT NULL AUTO_INCREMENT' : '';
			$columnSql .= sprintf(
				"%s %s(%d) %s,\n"
			, $column->getName(), $column->getType(), $column->getLength(), $autoIncrement);
		}

//		var_dump($columnSql);die;
		$sql = sprintf(
			'CREATE TABLE IF NOT EXISTS %s (' .
				'%s'.
			' PRIMARY KEY (%s))'
			, $name, $columnSql, $keys['primary']->getName());

//		var_dump($sql);die;
		$this->ci->get('SchemaWizard');
		die;
		return $sql;
	}

}