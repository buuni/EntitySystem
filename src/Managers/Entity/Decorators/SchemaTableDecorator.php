<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


use Entity\Interfaces\SchemaGetters;

class SchemaTableDecorator extends TableDecorator implements SchemaGetters {
    public function getSchema() {
        $schemaColumns = [];
        $columns = $this->getColumns();

        /** @var Column $column */
        foreach((array)$columns as $key => $column) {
            $schemaColumns[] = (new SchemaColumnDecorator($column))->getSchema();
        }

        return [
            'name' => $this->getName(),
            'comment' => $this->getComment(),
            'indexes' => $this->getIndexes()->all(),
            'columns' => $schemaColumns
        ];
    }
}