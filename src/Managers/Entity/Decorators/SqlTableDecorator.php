<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Decorators;


use Entity\Collection;
use Entity\Interfaces\SqlChanger;
use Entity\Interfaces\SqlCreator;
use Entity\Interfaces\TableInterface;

class SqlTableDecorator extends TableDecorator implements SqlChanger, SqlCreator {

    public function __construct(TableInterface $table) {
        parent::__construct($table);
        $sqlColumnDecorators = new Collection();

        foreach($this->getColumns()->all() as $key => $column) {
            $sqlColumnDecorators->set($key, new SqlColumnDecorator($column));
        }

        $this->setColumns($sqlColumnDecorators);
    }

    public function getChangeSql() {
        $columnsSql = new Collection();

        /**
         * @var string $key
         * @var SqlColumnDecorator $column
         */
        foreach($this->getColumns() as $key => $column) {
            $columnsSql->set($key, $column->getChangeSql());
        }

        $columnsSql = implode($columnsSql->all(), ",\n\t");

        $getIndexes = $this->getIndexes();
        $indexes['primary'] = $getIndexes['primary'] !== false ? sprintf('PRIMARY KEY (`%s`)', $getIndexes['primary']->getName()) : '';

        $indexes = preg_replace('| +|', ' ', trim(implode($indexes, ' ')));

        $columnsSql .= (strlen($indexes) > 0 ? ",\n\t" . $indexes : '') . "\n";

        $sql = sprintf(
            "CREATE TABLE IF NOT EXISTS `%s` (\n\t%s)\n" .
            "COLLATE = '%s'\n" .
            "ENGINE = %s;",
            $this->getCi()->get('TablesWizard')->tableName($this->getName()), // имя таблицы
            $columnsSql, // Столбцы и индексы
            $this->getCi()->get('settings')['tables']['charset'], // Кодировка таблицы
            $this->getCi()->get('settings')['tables']['engine'] // Движок таблицы
        );

        var_dump($sql);die;

        return $sql;
    }

    public function getCreateSql() {
        $columnsSql = new Collection();

        /**
         * @var string $key
         * @var SqlColumnDecorator $column
         */
        foreach($this->getColumns() as $key => $column) {
            $columnsSql->set($key, $column->getCreateSql());
        }

        $columnsSql = implode($columnsSql->all(), ",\n\t");

        $getIndexes = $this->getIndexes();
        $indexes['primary'] = $getIndexes['primary'] !== false ? sprintf('PRIMARY KEY (`%s`)', $getIndexes['primary']->getName()) : '';

        $indexes = preg_replace('| +|', ' ', trim(implode($indexes, ' ')));

        $columnsSql .= (strlen($indexes) > 0 ? ",\n\t" . $indexes : '') . "\n";

        $sql = sprintf(
            "CREATE TABLE IF NOT EXISTS `%s` (\n\t%s)\n" .
            "COLLATE = '%s'\n" .
            "ENGINE = %s;",
            $this->getCi()->get('TablesWizard')->tableName($this->getName()), // имя таблицы
            $columnsSql, // Столбцы и индексы
            $this->getCi()->get('settings')['tables']['charset'], // Кодировка таблицы
            $this->getCi()->get('settings')['tables']['engine'] // Движок таблицы
        );

        var_dump($sql);die;

        return $sql;
    }

}