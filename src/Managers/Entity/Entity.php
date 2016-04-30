<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Statements\TableStatement;
use Entity\Wizards\TablesWizard;
use Interop\Container\ContainerInterface;

require_once __DIR__ . '/helpers.php';

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
        $container->get('SchemaWizard');
    }

    public function prepareTable($name) {
        return new TableStatement($this->ci, $name);
    }

    public function executeDictionary(TableStatement $dictionary) {
        /** @var TablesWizard $wTable */
        $wTable = $this->ci->get('TablesWizard');
        $wTable->addTable($dictionary);
    }
}
