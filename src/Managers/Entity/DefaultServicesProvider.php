<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Interfaces\LoggerInterface;
use Entity\Wizards\DatabaseWizard;
use Entity\Wizards\SchemaWizard;
use Entity\Wizards\SqlWizard;
use Entity\Wizards\TablesWizard;
use Pimple\ServiceProviderInterface;
use Pimple\Container as PimpleContainer;

class DefaultServicesProvider implements ServiceProviderInterface
{

    public function register(PimpleContainer $container)
    {
        // Если соеденение с базой не было переданно заранее в настройках, то выбросится исключение
        if (isset($container['settings']['driver'])) {
            $container['DatabaseWizard'] = function($container) {
                return new DatabaseWizard($container);
            };
        } else {
            throw new \InvalidArgumentException('Not defined object database connection in $settings["driver"]');
        }

        if(!isset($container['TablesWizard'])) {
            $container['TablesWizard'] = function($container) {
                return new TablesWizard($container);
            };
        }

        if(!isset($container['SqlWizard'])) {
            $container['SqlWizard'] = function($container) {
                return new SqlWizard($container);
            };
        }

        if(!isset($container['SchemaWizard'])) {
            $container['SchemaWizard'] = function($container) {
                return new SchemaWizard($container);
            };
        }
    }
}
