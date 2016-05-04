<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\Interfaces\TableInterface;
use Entity\Interfaces\TablesTools;

abstract class AbstractTablesTools extends Wizard implements TablesTools {
    protected $prefix;

    public function __construct(Container $ci) {
        parent::__construct($ci);
        $this->prefix = $this->settings['tables']['prefix'];
    }

    /**
     * true - таблица существует, false - таблица не существует
     * @param $name
     * @return bool|null
     */
    abstract public function tableExists($name);

    abstract public function getAllTables();

    abstract public function getTable($name);

    abstract public function addTable(TableInterface $table);

    abstract public function editTable(TableInterface $table);

    final public function tableName($name) {
        return $this->prefix . $name;
    }
}