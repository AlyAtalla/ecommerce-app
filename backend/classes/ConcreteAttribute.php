<?php

require_once 'Attribute.php';

class ConcreteAttribute extends Attribute {
    private $value;

    public function __construct($id, $name, $value) {
        parent::__construct($id, $name);
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }
}
