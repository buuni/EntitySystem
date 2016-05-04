<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


use Entity\Interfaces\SchemaGetters;

class SchemaColumnDecorator extends ColumnDecorator implements SchemaGetters {
    public function getSchema() {
        return [
            'name' => $this->getName(),
            'type' => $this->getType()[0],
            'format' => $this->getType()[1],
            'property' => $this->getProperty()
        ];
    }
}