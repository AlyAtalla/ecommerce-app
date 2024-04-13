<?php

require_once 'Product.php';

class ConcreteProduct extends Product {
    private $price;

    public function __construct($id, $name, $price) {
        parent::__construct($id, $name);
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }
}
