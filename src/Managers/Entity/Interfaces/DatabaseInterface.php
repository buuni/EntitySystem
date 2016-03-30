<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Interfaces;

interface DatabaseInterface
{

    public function select($columns = ['*']);
    public function insert($columns = []);
    public function update($pairs = []);
    public function delete($table = null);
    public function query($sql = null);
}
