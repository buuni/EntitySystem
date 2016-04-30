<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\Statements\TableStatement;

class TablesWizard extends AbstractTablesTools {
	/** @var DatabaseWizard */
	protected $wBase;

    /** @var SchemaWizard */
    protected $wSchema;

    protected $repositoryTables = [];

	public function __construct(Container $ci) {
		parent::__construct($ci);
		$this->wBase = $ci->get('DatabaseWizard');
        $this->wSchema = $ci->get('SchemaWizard');
	}

    public function getTable($name) {
        if(isset($this->getAllRepositoryTables()[$name])) {
            return $this->getAllRepositoryTables()[$name];
        }

        return null;
    }

    public function getAllTables() {
        return $this->getAllRepositoryTables();
    }

    public function addTable(TableStatement $statement) {
        if(!$this->tableExists($statement->getName())) {
            $this->wBase->createTable($statement);
            $this->wSchema->addTable($statement);
        } else {
            $this->editTable($statement);
        }
    }

    public function editTable(TableStatement $statement) {
        if($this->tableExists($statement->getName())) {
            $this->wBase->alterTable($statement);
            $this->wSchema->editTable($statement);
        } else {
            $this->addTable($statement);
        }
    }

    public function tableExists($name) {
		$tables = $this->getAllTables();
		return array_search($this->tableName($name), $tables) === false ? false : true;
	}

    protected function updateRepositoryTables() {
        $tablesStm = $this->wBase->query('SHOW TABLES');
        $this->repositoryTables = [];

        foreach($tablesStm as $table) {
            $this->repositoryTables[] = $table['Tables_in_entity'];
        }
    }

    protected function getAllRepositoryTables() {
        if(empty($this->repositoryTables)) {
            $this->updateRepositoryTables();
        }

        return $this->repositoryTables;
    }

}