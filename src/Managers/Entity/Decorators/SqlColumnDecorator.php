<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


use Entity\Interfaces\SqlChanger;
use Entity\Interfaces\SqlCreator;
use Entity\Tables\Column;

class SqlColumnDecorator extends ColumnDecorator implements SqlCreator, SqlChanger {

    public function getChangeSql() {
        // TODO: Implement getChangeSql() method.
    }

    public function getCreateSql() {
        $property['null'] = $this->getProperty()['null'] === true ? 'NULL' : 'NOT NULL';
        $property['auto_increment'] = $this->getProperty()['auto_increment'] === true ? 'AUTO_INCREMENT' : '';

        // Определяем, существует ли callback и выполняем его.
        $callback = isset($this->getType()[2]) ? $this->getType()[2] : null;
        $callback = is_callable($callback) ? $callback($this) : null;

        // Получаем DEFAULT значение либо через callback, либо через обычное свойство.
        if($this->getProperty()['default_value'] !== false && $callback !== null) {
            $property['default'] = sprintf('DEFAULT %s', $callback);
        } else if($this->getProperty()['default_value'] !== false) {
            $property['default'] = sprintf("DEFAULT '%s'", $this->getProperty()['default_value']);
        } else {
            $property['default'] = '';
        }

        $property = preg_replace('| +|', ' ', trim(implode($property, ' ')));

        $format = $this->getType()[1] !== null ? sprintf('(%s)', $this->getType()[1]) : '';

        $sql = sprintf('`%s` %s%s %s', $this->getName(), $this->getType()[0], $format, $property);

        return $sql;
    }

}