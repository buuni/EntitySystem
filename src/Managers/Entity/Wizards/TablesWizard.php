<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;

class TablesWizard extends Wizard {
	/** @var DatabaseWizard */
	protected $db;

	protected $prefix;

	public function __construct(Container $ci) {
		parent::__construct($ci);
		$this->db = $this->ci->get('DatabaseWizard');
		$this->prefix = $this->ci->get('settings')['tables']['prefix'];
	}

	/**
	 * true - таблица существует, false - таблица не существует
	 * @param $name
	 * @return bool|null
	 */
	public function tableExists($name) {
		$tables = $this->getAllTables();
		return array_search($this->tableName($name), $tables) === false ? false : true;
	}

	public function getAllTables() {
		$tables = [];
		$tablesStm = $this->db->query('SHOW TABLES')[0];

		foreach($tablesStm as $table) {
			$tables[] = $table;
		}

		return $tables;
	}

	public function tableName($name) {
		return $this->prefix . $name;
	}

}