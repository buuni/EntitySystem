<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Decorators\TableStatementDecorator;
use Entity\Interfaces\TableInterface;
use Entity\Tables\SchemaTable;
use Entity\Tables\Table;
use Entity\Wizards\SchemaWizard;
use Interop\Container\ContainerInterface;

/**
 * Class Entity
 * Выступает в роле фасада.
 *
 * @package Entity
 */
class Entity
{
    /** @var ContainerInterface  */
    protected $ci;

    public function __construct($container = [])
    {
        if (is_array($container)) {
            $container = new Container($container);
        }

        if (!$container instanceof ContainerInterface) {
            throw new \InvalidArgumentException('Expected a ContainerInterface');
        }
        $this->ci = $container;
    }

    /**
     * @param $name
     * @return TableStatementDecorator
     */
    public function prepareTable($name) {
        return new TableStatementDecorator(new Table($this->ci, $name));
    }

    public function executeDictionary(TableInterface $dictionary) {
        /** @var SchemaWizard $wSchema */
        $wSchema = $this->ci->get('SchemaWizard');
        $wSchema->addTable($dictionary);
    }
}
