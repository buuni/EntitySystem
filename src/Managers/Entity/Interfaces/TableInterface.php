<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Interfaces;


use Entity\Collection;
use Entity\Tables\ColumnType;

interface TableInterface {
    public function addColumn($name, array $type, array $property = []);

    public function getColumns();
    public function setColumns(Collection $columns);
    public function getIndexes();
    public function setIndexes(Collection $keys);
    public function addIndex($index, $value);
    public function getComment();
    public function setComment($comment);
    public function getName();
    public function setName($name);
}