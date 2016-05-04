<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


class TableStatementDecorator extends TableDecorator {
    public function definition($name, $type, $format = null, array $property = []) {
        $type = $this->getCi()->get('TypesWizard')->type($type, $format);
        $this->addColumn($name, $type, $property);

        return $this;
    }

    public function setPrimaryKey($columnName) {
        if($this->getColumns()->has($columnName)) {
            $this->addIndex('primary', $this->getColumns()->get($columnName));
        }

        return $this;
    }
}