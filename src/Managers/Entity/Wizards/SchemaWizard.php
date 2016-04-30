<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Container;
use Entity\Statements\TableStatement;
use Entity\Tables\Column;

class SchemaWizard extends AbstractTablesTools {

	protected $schema = [];

    protected $schemaDefault = [
        'tables' => []
    ];

    protected $schemaSrc;

	public function __construct(Container $ci) {
		parent::__construct($ci);
        $this->schemaSrc = __DIR__ . '/../schema.json';

        if(!is_file($this->schemaSrc) || strlen(file_get_contents($this->schemaSrc, true)) <= 0) {
            file_put_contents($this->schemaSrc, json_encode($this->schemaDefault), true);
        }

        $this->schema = json_decode(file_get_contents($this->schemaSrc, true), true);
    }

    public function getTable($name) {
        if($this->tableExists($name)) {
            return $this->schema['tables'][$name];
        }

        return false;
    }

    public function getAllTables() {
        return $this->schema['tables'];
    }

    public function addTable(TableStatement $table) {
		$tablePrepare = [];

		/** @var Column $column */
		foreach($table->getColumns() as $column) {
			$tablePrepare[$table->getName()][] = [
				'name' => $column->getName(),
				'type' => $column->getType(),
				'length' => $column->getLength(),
				'options' => $column->getOptions(),
				'keys' => $column->getKeys()
			];
		}

		$this->schema['tables'] += $tablePrepare;

	}

    public function editTable(TableStatement $statement) {
        unset($this->schema['tables'][$statement->getName()]);
        $this->addTable($statement);
    }

    public function tableExists($name) {
        if(isset($this->schema['tables'][$name])) {
            return true;
        }

        return false;
    }

    public function __destruct() {
        file_put_contents($this->schemaSrc, json_encode($this->schema), true);
    }

    public function compare(TableStatement $statement) {
        if(($table = $this->getTable($statement->getName()))) {
            $statementColumns = $statement->getColumns()->all();
            $compare = [];
            $result = [];

            /** @var Column $column */
            foreach($statementColumns as $column) {
                $compare[] = [
                    'name' => $column->getName(),
                    'type' => $column->getType(),
                    'length' => $column->getLength(),
                    'options' => $column->getOptions(),
                    'keys' => $column->getKeys(),
                ];
            }

            foreach($compare as $statementColumn) {
                foreach($statementColumn as $property => $value) {
                    switch ($property) {
                        case 'name':
                            if(array_search($value, array_column($table, 'name')) === false) {
                                $result['create'][] = $statementColumns[$value];
                                continue 3;
                            }
                            break;

                        case 'type':
                            if(array_column($table, 'type', 'name')[$statementColumn['name']] !== $value) {
                                $result['change']['type'][] = $statementColumns[$statementColumn['name']];
                            }
                            break;

                        case 'length':
                            if(array_column($table, 'length', 'name')[$statementColumn['name']] !== $value) {
                                $result['change']['length'][] = $statementColumns[$statementColumn['name']];
                            }
                            break;
                        case 'options':
                            foreach($value as $option => $val) {
                                if($option == 'comment') continue;
                                if(array_column($table, 'options', 'name')[$statementColumn['name']][$option] !== $value[$option]) {
                                    $result['change']['options'][$option][] = $statementColumns[$statementColumn['name']];
                                }
                            }
                            break;

                        // TODO разобраться с удалением и добавлением ключей
                        case 'keys':
                            foreach($value as $key => $val) {
                                if(array_column($table, 'keys', 'name')[$statementColumn['name']][$key] !== $value[$key]) {
                                    $result['change']['keys'][$key][] = $statementColumns[$statementColumn['name']];
                                }
                            }
                            break;
                    };
                }
            }

            return $result;
        }

        return null;
    }

}