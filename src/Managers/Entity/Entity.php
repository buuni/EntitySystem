<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Statements\TableStatement;
use Entity\Wizards\DatabaseWizard;
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

    public function prepareTable($name) {
        return new TableStatement($this->ci, $name);
    }

    public function executeDictionary(TableStatement $dictionary) {
        /** @var DatabaseWizard $wDatabase */
        $wDatabase = $this->ci->get('DatabaseWizard');
        $wDatabase->createTable($dictionary);
    }
}
