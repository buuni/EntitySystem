<?php
/**
 * Author: Demko Igor
 */

namespace Controllers;

use Entity\Statements\ColumnType;
use Entity\Statements\TablePropertyStatement;
use Helpers\DatabaseEntityMigration;
use Helpers\LoggerEntityMigration;
use Interop\Container\ContainerInterface;
use Entity\Entity;

abstract class Controller
{
    /**
     * @var ContainerInterface
     */
    protected $ci;

    /**
     * @var Entity
     */
    protected $entity;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;

        try {
            $settings = [
                'settings' => [
                    // Настройки системы
                    'system' => [
                        'debug' => true,
                        'cache' => true
                    ],

                    // Настройки таблиц
                    'tables' => [
                        'prefix' => 'ent_',
                        'engine' => 'InnoDB',
                        'charset' => 'utf8_general_ci'
                    ],

                    // Драйвер для подключения к БД
                    'driver' => [
                        'PDO' => [
                            'type' => 'mysql',
                            'host' => '127.0.0.1',
                            'database' => 'entity',
                            'user' => 'root',
                            'password' => '',
                            'charset' => 'utf8'
                        ]
                    ]
                ]
            ];

            $this->entity = new Entity($settings);

            $dict = $this->entity->prepareTable('user_groups');
            $dict->setAlias('Группы пользователй');
            $dict
                ->definition('id', 'integer1', 11, 'Индекс группы')
                ->definition('name23', 'varchar', 255, 'Наименование группы пользователей')
                ->definition('test_field', 'varchar', 250, 'Наименование группы пользователей')
//                ->definition('date', 'datetime', false, 'Дата создания группы')
                ->autoIncrement('name23')
                ->setPrimaryKey('id');


            $this->entity->executeDictionary($dict);

        } catch (\Exception $e) {
            $ci->logger->error($e->getMessage());
            var_dump($e->getMessage());
        }
    }
}
