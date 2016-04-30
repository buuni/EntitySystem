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
			' PRIMARY KEY (%s)' .
			") COLLATE = '%s'\n" .
			'ENGINE=%s'
			, $name, $columnSql, $keys['primary']->getName(), $this->ci->settings['tables']['charset'], $this->ci->settings['tables']['engine']);

//var_dump($sql);die;
		return $sql;
	}

	public function alterTable($name, $columns, $keys = []) {

	}


	public function alterNewColumnTable($table, Column $column) {
		$sql = '';

		$sql = sprintf('ALTER TABLE `%s` ADD COLUMN `%s` %s(%s)', $table, $column->getName(), $column->getType(), $column->getLength());
//		$sql = sprintf('A')
//		var_dump($sql);die;
		return $sql;
	}


}