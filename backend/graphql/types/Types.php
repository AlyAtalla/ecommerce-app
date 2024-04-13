<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

// Define the Attribute type
$attributeType = new ObjectType([
    'name' => 'Attribute',
    'fields' => [
        'id' => ['type' => Type::id()],
        'name' => ['type' => Type::string()],
        'value' => ['type' => Type::string()],
    ],
]);

// Define the Product type
$productType = new ObjectType([
    'name' => 'Product',
    'fields' => [
        'id' => ['type' => Type::id()],
        'name' => ['type' => Type::string()],
        'attributes' => ['type' => Type::listOf($attributeType)],
    ],
]);

// Define the Category type
$categoryType = new ObjectType([
    'name' => 'Category',
    'fields' => [
        'id' => ['type' => Type::id()],
        'name' => ['type' => Type::string()],
        'products' => ['type' => Type::listOf($productType)],
    ],
]);
