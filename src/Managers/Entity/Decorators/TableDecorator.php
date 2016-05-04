<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


use Entity\Collection;
use Entity\Interfaces\TableInterface;
use Entity\Tables\Table;

abstract class TableDecorator extends Table {

    /** @var Table */
    protected $decoratedTable;
    
    public function __construct(TableInterface $table) {
        $this->decoratedTable = $table;
    }

    public function getColumns() {
        return $this->decoratedTable->getColumns();
    }
    
    public function addIndex($index, $value) {
        $this->decoratedTable->addIndex($index, $value);
    }
    
    public function addColumn($name, array $type, array $property = []) {
        $this->decoratedTable->addColumn($name, $type, $property);
    }
    
    public function getComment() {
        return $this->decoratedTable->getComment();
    }
    
    public function getIndexes() {
        return $this->decoratedTable->getIndexes();
    }
    
    public function getName() {
        return $this->decoratedTable->getName();
    }
    
    public function setColumns(Collection $columns) {
        $this->decoratedTable->setColumns($columns);
    }
    
    public function setComment($comment) {
        $this->decoratedTable->setComment($comment);
    }
    
    public function setIndexes(Collection $indexes) {
        $this->decoratedTable->setIndexes($indexes);
    }
    
    public function setName($name) {
        $this->decoratedTable->setName($name);
    }
    
    public function getCi() {
        return $this->decoratedTable->getCi();
    }

}