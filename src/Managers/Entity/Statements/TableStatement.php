<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Statements;


use Entity\Collection;
use Entity\Container;
use Entity\Tables\Column;
use Entity\Wizards\SchemaWizard;
use Entity\Wizards\TablesWizard;

class TableStatement extends Statement {

	protected $name;

	protected $alias;

	/** @var Collection */
	protected $columns;

	/** @var TablesWizard */
	protected $wTables;

	/** @var  SchemaWizard */
	protected $wSchema;

	protected $primary = null;

	public function __construct(Container $ci, $name) {
		parent::__construct($ci);
		$this->columns = new Collection();
		$this->wTables = $ci->get('TablesWizard');
		$this->wSchema = $ci->get('SchemaWizard');

		$this->setName($name);
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setAlias($alias) {
		$this->alias = $alias;
	}

	public function definition($column, $type, $length, $comment = null) {
		if(!$this->columns->has($column)) {
			$this->columns->set($column, new Column($column, $type, $length, ['comment' => $comment]));
		}

		return $this;
	}

	public function setPrimaryKey($columnName) {
		if($this->columns->has($columnName)) {
			/** @var Column $column */
			$column = $this->columns->get($columnName);
			$column->setPrimaryKey(true);
			$this->primary = &$column;
		}

		return $this;
	}

	public function autoIncrement($columnName) {
		if($this->columns->has($columnName)) {
			/** @var Column $column */
			$column = $this->columns->get($columnName);
			$column->setAutoIncrement(true);
		}

		return $this;
	}

	/**
	 * Getter name.
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Getter alias.
	 * @return mixed
	 */
	public function getAlias() {
		return $this->alias;
	}

	/**
	 * Getter columns.
	 * @return Collection
	 */
	public function getColumns() {
		return $this->columns;
	}

	/**
	 * Getter primary.
	 * @return null | Column
	 */
	public function getPrimary() {
		return $this->primary;
	}

}