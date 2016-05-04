<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Tables;


use Entity\Collection;
use Entity\Interfaces\Registered;

class DefaultTypesCollection implements Registered {

    public function register(Collection &$collection) {
        $collection->set('varchar', $this->callback('varchar'));
        $collection->set('integer', $this->callback('integer'));
        $collection->set('date', $this->callback('date'));
    }

    protected function varchar($format) {
        return ['varchar', $this->setDefaultFormat($format, 255)];
    }

    protected function integer($format) {
        return ['integer', $this->setDefaultFormat($format, 11)];
    }

    protected function date($format = null) {
        $callback = function(Column $context) {
            if($context->getProperty()['default_value'] == 'update') {
                return "'' ON UPDATE CURRENT_TIMESTAMP";
            }

            if($context->getProperty()['default_value'] == 'null update') {
                return "NULL ON UPDATE CURRENT_TIMESTAMP";
            }

            return null;
        };

        return ['date', null, $callback];
    }

    protected function setDefaultFormat($data, $default) {
        return $data !== null ? $data : $default;
    }

    protected function callback($methodName) {
        return function($format) use ($methodName) {
            return $this->$methodName($format);
        };
    }

}