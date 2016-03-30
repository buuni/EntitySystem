<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

class Table
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
