<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Interfaces;


use Entity\Statements\TableStatement;

interface TablesTools {
    public function getTable($name);
    public function getAllTables();
    public function tableName($name);
    public function tableExists($name);
    public function addTable(TableStatement $statement);
    public function editTable(TableStatement $statement);
}