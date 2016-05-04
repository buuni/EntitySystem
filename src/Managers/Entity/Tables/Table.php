<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Tables;


use Entity\Collection;
use Entity\Container;
use Entity\Interfaces\TableInterface;

class Table implements TableInterface {

    /** @var Container */
    protected $ci;

    protected $name;

    protected $comment;

    /** @var Collection */
    protected $indexes;

    /** @var Collection */
    protected $columns;

    public function __construct(Container $ci, $name) {
        $this->ci = $ci;
        $this->name = $name;
        $this->columns = new Collection();
        $this->indexes = new Collection([
            'primary' => false,
            'unique' => false,
            'foregin' => false,
        ]);
    }

    public function addColumn($name, array $type, array $property = []) {
        $column = new Column($name, $this);
        $column->setType($type);
        $column->setProperty($property);

        $this->columns->set($name, $column);
    }

    /**
     * Getter columns.
     * @return Collection
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * Setter columns.
     * @param Collection $columns
     */
    public function setColumns(Collection $columns) {
        $this->columns = $columns;
    }

    /**
     * Getter indexes.
     * @return Collection
     */
    public function getIndexes() {
        return $this->indexes;
    }

    /**
     * Setter indexes.
     * @param Collection $indexes
     */
    public function setIndexes(Collection $indexes) {
        $this->indexes = $indexes;
    }

    public function addIndex($index, $value) {
        if($this->indexes->has($index)) {
            $this->indexes[$index] = $value;
        }
    }

    /**
     * Getter comment.
     * @return mixed
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * Setter comment.
     * @param mixed $comment
     */
    public function setComment($comment) {
        $this->comment = $comment;
    }

    /**
     * Getter name.
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Setter name.
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Getter ci.
     * @return Container
     */
    public function getCi() {
        return $this->ci;
    }
}