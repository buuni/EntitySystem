<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Exception\InstanceException;
use Entity\Interfaces\DatabaseInterface;
use Entity\Interfaces\LoggerInterface;
use Pimple\ServiceProviderInterface;
use Pimple\Container as PimpleContainer;

class DefaultServicesProvider implements ServiceProviderInterface
{

    public function register(PimpleContainer $container)
    {
        if (!isset($container['connect'])) {
            throw new \InvalidArgumentException('Not defined object database connection in $settings["connect"]');
        }

        if (!isset($container['logger'])) {
            $container['logger'] = function ($container) {
                return new LoggerCap();
            };
        }
    }
}
