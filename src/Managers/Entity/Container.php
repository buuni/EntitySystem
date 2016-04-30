<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Entity\Exception\InstanceException;
use Entity\Interfaces\DatabaseInterface;
use Pimple\Container as PimpleContainer;
use Interop\Container\ContainerInterface;

class Container extends PimpleContainer implements ContainerInterface
{

    /**
     * Default settings
     *
     * @var array
     */
    private $defaultSettings = [
        'system' => [
            'debug' => true,
            'cache' => true,
        ],

        'tables' => [
            'prefix' => 'std_',
            'engine' => 'InnoDB',
            'charset' => 'utf8_general_ci'
        ]
    ];

    /**
     * Create new container
     *
     * @param array $values The parameters or objects.
     */
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $userSettings = isset($values['settings']) ? $values['settings'] : [];

        $this->registerDefaultServices($userSettings);
    }

    private function registerDefaultServices($userSettings)
    {
        $defaultSettings = $this->defaultSettings;

        /**
         * This service MUST return an array or an
         * instance of \ArrayAccess.
         *
         * @return array|\ArrayAccess
         */

        $this['settings'] = function () use ($userSettings, $defaultSettings) {
            return new Collection(array_merge($defaultSettings, $userSettings));
        };

        // Создаем провайдер сервисов по умолчанию.
        $defaultProvider = new DefaultServicesProvider();
        $defaultProvider->register($this);
    }

    /********************************************************************************
     * Methods to satisfy Interop\Container\ContainerInterface
     *******************************************************************************/

    public function get($id)
    {
        if (!$this->offsetExists($id)) {
            throw new \InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $id));
        }
        return $this->offsetGet($id);
    }


    public function has($id)
    {
        return $this->offsetExists($id);
    }


    /********************************************************************************
     * Magic methods for convenience
     *******************************************************************************/

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __isset($name)
    {
        return $this->has($name);
    }
}
