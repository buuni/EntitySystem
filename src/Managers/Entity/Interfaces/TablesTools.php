<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Interfaces;


interface TablesTools {
    public function getTable($name);
    public function getAllTables();
    public function tableName($name);
    public function tableExists($name);
    public function addTable(TableInterface $table);
    public function editTable(TableInterface $table);
}