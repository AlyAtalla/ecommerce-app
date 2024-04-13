<?php

require_once 'Category.php';

class ConcreteCategory extends Category {
    private $description;

    public function __construct($id, $name, $description) {
        parent::__construct($id, $name);
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }
}
