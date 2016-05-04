<?php
/**
 * Author: Demko Igor
 */

namespace Entity\Wizards;


use Entity\Collection;
use Entity\Container;
use Entity\Interfaces\Registered;
use Entity\Tables\DefaultTypesCollection;

class TypesWizard extends Wizard {

    /** @var Collection */
    protected $typesCollection;

    /** @var Registered */
    protected $defaultTypes;

    public function __construct(Container $ci) {
        parent::__construct($ci);
        $this->typesCollection = new Collection();

        $this->setDefaultTypes();
    }

    public function type($type, $format = null) {
        if($this->typesCollection->has($type)) {
            /** @var callable $callback */
            $callback = $this->typesCollection->get($type);
            return $callback($format);
        }
    }

    protected function setDefaultTypes() {
        $this->defaultTypes = new DefaultTypesCollection();
        $this->defaultTypes->register($this->typesCollection);
    }

}