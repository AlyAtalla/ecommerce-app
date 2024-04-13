<?php

abstract class Category {
    protected $id;
    protected $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    // Abstract methods to be implemented by subclasses
    abstract public function getDescription();
}
