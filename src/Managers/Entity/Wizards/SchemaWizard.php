<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Collection;
use Entity\Container;
use Entity\Interfaces\TableInterface;
use Entity\Tables\ColumnType;
use Entity\Tables\SchemaTable;
use Entity\Tables\Table;

class SchemaWizard extends AbstractTablesTools {

    /** @var Collection */
	protected $tables;

    protected $schemaDefault = [
        'tables' => []
    ];

    protected $schemaSrc;

    /** @var TypesWizard */
    protected $wTypes;

    /** @var TablesWizard */
    protected $wTables;

	public function __construct(Container $ci) {
		parent::__construct($ci);

        $this->wTypes = $ci->get('TypesWizard');
        $this->wTables= $ci->get('TablesWizard');

        $this->tables = new Collection();
        $this->schemaSrc = __DIR__ . '/../schema.json';

        if(!is_file($this->schemaSrc) || strlen(file_get_contents($this->schemaSrc, true)) <= 0) {
            file_put_contents($this->schemaSrc, json_encode($this->schemaDefault), true);
        }

        $schema = json_decode(file_get_contents($this->schemaSrc, true), true);

        foreach((array)$schema['tables'] as $table) {
            $schemaTable = new Table($this->ci, $table['name']);
            $schemaTable->setIndexes(new Collection($table['indexes']));
            $schemaTable->setComment($table['comment']);

            foreach((array)$table['columns'] as $column) {
                $schemaTable->addColumn($column['name'], $this->wTypes->type($column['type'], $column['format']), $column['property']);
            }

            $this->tables->set($table['name'], $schemaTable);
        }
    }

    public function tableExists($name) {
       return $this->tables->has($name);
    }

    public function getTable($name) {
        if($this->tableExists($name)) {
            return $this->tables->get($name);
        }

        return null;
    }

    public function getAllTables() {
        return $this->tables->all();
    }

    public function addTable(TableInterface $table) {
        if(!$this->tableExists($table->getName())) {
            $this->wTables->addTable($table);
        } else if($this->getTable($table->getName()) != $table){
            $this->wTables->editTable($table);
        }

        $this->tables->set($table->getName(), $table);
    }

    public function editTable(TableInterface $table) {
        if($this->tableExists($table->getName())) {
            $this->tables->set($table->getName(), $table);
        }
    }

    public function __destruct() {
        $schema = [
            'tables' => []
        ];

        /** @var SchemaTable $table */
        foreach($this->tables as $table) {
            $schema['tables'][] = $table->getSchema();
        }

        file_put_contents($this->schemaSrc, json_encode($schema), true);
    }

}