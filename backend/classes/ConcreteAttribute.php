<?php

require_once 'Attribute.php';

class ConcreteAttribute {
    private $value;

    public function __construct($id, $name, $value) {
        // Remove the line below since the current class scope has no parent
        // parent::__construct($id, $name);
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }
}
