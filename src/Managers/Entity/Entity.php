<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Interop\Container\ContainerInterface;

class Entity
{
    protected $di;

    public function __construct($container = [])
    {
        if (is_array($container)) {
            $container = new Container($container);
        }

        if (!$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Expected a ContainerInterface');
        }

        $this->di = $container;

        // Заполняем коллекции с таблицами и столбцами.
        $this->defaultFillCollections();
    }

    public function createTable($tableName, $fields)
    {
        $fields[$tableName . '_unique_id'] = function ($value) {
            return $value;
        };


        $sql = '';
    }

    protected function defaultFillCollections()
    {
        $connect = $this->di->get('connect');
        /** @var Collection $tables */
        $tables = $this->di->get('tables');

        $tablesInDB = $connect->query("SHOW TABLES");

        foreach ($tablesInDB as $table) {
            foreach ($table as $name) {
                $tables[] = new Table($name);
            }
        }

        var_dump($tables);
        die;
    }
}
