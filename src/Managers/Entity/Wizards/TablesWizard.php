<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Collection;
use Entity\Container;
use Entity\Interfaces\TableInterface;
use Entity\Statements\TableStatement;

class TablesWizard extends AbstractTablesTools {
	/** @var DatabaseWizard */
	protected $wBase;

    /** @var Collection */
    protected $tables;

    /** @var Collection */
    protected $tablesRepository;

	public function __construct(Container $ci) {
		parent::__construct($ci);

		$this->wBase = $ci->get('DatabaseWizard');
        $this->tables = new Collection();
        $this->tablesRepository = new Collection();
	}

    public function addTable(TableInterface $table) {
        if($this->getTablesRepository()->has($this->tableName($table->getName()))) {
            $this->editTable($table);
        } else {
            $this->wBase->createTable($table);
        }
    }

    public function editTable(TableInterface $table) {
        if(!$this->getTablesRepository()->has($this->tableName($table->getName()))) {
            $this->addTable($table);
        } else {
            $this->wBase->alterTable($table);
        }
    }

    public function getAllTables() {
        // TODO: Implement getAllTables() method.
    }

    public function getTable($name) {
        // TODO: Implement getTable() method.
    }

    public function tableExists($name) {
        // TODO: Implement tableExists() method.
    }

    /**
     * @return Collection
     */
    protected function getTablesRepository() {
        if(empty($this->tablesRepository->all())) {
            $queryTables = $this->wBase->getAllTables();

            foreach((array)$queryTables as $table) {
                $this->tablesRepository->set(array_values($table)[0], true);
            }
        }

        return $this->tablesRepository;
    }

}