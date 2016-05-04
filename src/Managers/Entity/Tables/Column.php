<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Tables;


use Entity\Interfaces\TableInterface;

class Column {

    /** @var TableInterface */
    protected $parent;

    protected $name;

    /** @var callable */
    protected $type;

    protected $property = [
        'default_value' => false,
        'auto_increment' => false,
        'null' => false,
    ];

    public function __construct($name, TableInterface $parent) {
        $this->parent = $parent;
        $this->name = $name;
    }

    /**
     * Getter property.
     * @return array
     */
    public function getProperty() {
        return $this->property;
    }

    /**
     * Setter property.
     * @param array $property
     */
    public function setProperty($property) {
        $this->property = array_merge($this->property, $property);
//        var_dump($this->property);die;
    }

    /**
     * Getter parent.
     * @return Table
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Setter parent.
     * @param TableInterface $parent
     */
    public function setParent(TableInterface $parent) {
        $this->parent = $parent;
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
     * Getter type.
     * @return callable
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Setter type.
     * @param callable $type
     */
    public function setType($type) {
        $this->type = $type;
    }

}