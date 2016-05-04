<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Interfaces;


use Entity\Collection;

interface Registered {
    public function register(Collection &$collection);
}