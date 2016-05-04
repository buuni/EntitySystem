<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Collection;
use Entity\Container;
use Entity\Decorators\SqlColumnDecorator;
use Entity\Decorators\SqlTableDecorator;
use Entity\Interfaces\TableInterface;
use Entity\Tables\Column;
use Entity\Tables\Table;

class SqlWizard extends Wizard {

	public function __construct(Container $ci) {
		parent::__construct($ci);
	}

	/**
	 * @param TableInterface $table
	 * @return string
	 */
	public function createTable(TableInterface $table) {
		$table = new SqlTableDecorator($table);
		return $table->getCreateSql();
	}

	public function alterTable(TableInterface $table) {
		$table = new SqlTableDecorator($table);
		return $table->getChangeSql();
	}


	public function alterNewColumnTable($table, ColumnStatement $column) {
		$sql = '';

		$sql = sprintf('ALTER TABLE `%s` ADD COLUMN `%s` %s(%s)', $table, $column->getName(), $column->getType(), $column->getLength());
//		$sql = sprintf('A')
//		var_dump($sql);die;
		return $sql;
	}

	protected function getAlterColumn(ColumnStatement $column) {

	}


}