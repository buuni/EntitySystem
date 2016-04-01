<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Interfaces\LoggerInterface;
use Entity\Wizards\SQLWizard;
use Pimple\ServiceProviderInterface;
use Pimple\Container as PimpleContainer;

class DefaultServicesProvider implements ServiceProviderInterface
{

    public function register(PimpleContainer $container)
    {
        // Если соеденение с базой не было переданно заранее в настройках, то выбросится исключение
        if (!isset($container['connect'])) {
            throw new \InvalidArgumentException('Not defined object database connection in $settings["connect"]');
        }

        // Сервис протоколирования по-умолчанию.
        if (!isset($container['logger'])) {
            $container['logger'] = function ($container) {
                return new LoggerCap();
            };
        }

        // Сервис для доступа к коллекции таблиц.
        if (!isset($container['SQLWizard'])) {
            $container['tablesWizard'] = function ($container) {
                return new SQLWizard();
            };
        }
    }
}
