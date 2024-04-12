<?php

namespace MyNamespace\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Category',
            'description' => 'A type representing a category',
            'fields' => [
                'id' => [
                    'type' => Type::id(),
                    'description' => 'The ID of the category',
                ],
                'name' => [
                    'type' => Type::string(),
                    'description' => 'The name of the category',
                ],
                'description' => [
                    'type' => Type::string(),
                    'description' => 'The description of the category',
                ],
                // Add more fields as needed
            ],
        ]);
    }
}
