<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


use Entity\Collection;
use Entity\Interfaces\TableInterface;
use Entity\Tables\Column;

abstract class ColumnDecorator extends Column {

    /** @var Column */
    protected $decoratedColumn;

    public function __construct(Column $column) {
        $this->decoratedColumn = $column;
    }
    
    public function getParent() {
        return $this->decoratedColumn->getParent();
    }
    
    public function getName() {
        return $this->decoratedColumn->getName();
    }
    
    public function getProperty() {
        return $this->decoratedColumn->getProperty();
    }
    
    public function getType() {
        return $this->decoratedColumn->getType();
    }
    
    public function setName($name) {
        $this->decoratedColumn->setName($name);
    }
    
    public function setParent(TableInterface $parent) {
        $this->decoratedColumn->setParent($parent);
    }
    
    public function setProperty($property) {
        $this->decoratedColumn->setProperty($property);
    }
    
    public function setType($type) {
        $this->decoratedColumn->setType($type);
    }

}