<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Interop\Container\ContainerInterface;

class Entity
{

    public function __construct($container = [])
    {
        if (is_array($container)) {
            $container = new Container($container);
        }

        if (!$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Expected a ContainerInterface');
        }

        $this->container = $container;
    }

    public function createTable($tableName, $fields)
    {
        $fields[$tableName . '_unique_id'] = function ($value) {
            return $value;
        };


        $sql = '';
    }
}
