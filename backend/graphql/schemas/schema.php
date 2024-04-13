<?php

use GraphQL\Type\Schema;

$schema = new Schema([
    'query' => new ObjectType([
        'name' => 'Query',
        'fields' => [
            'getCategory' => [
                'type' => $categoryType,
                'args' => ['id' => ['type' => Type::id()]],
                'resolve' => function ($rootValue, $args, $context, $info) {
                    return (new CategoryResolver())->resolve($args);
                },
            ],
            'getAllCategories' => [
                'type' => Type::listOf($categoryType),
                'resolve' => function ($rootValue, $args, $context, $info) {
                    return (new CategoryResolver())->resolve($args);
                },
            ],
            // Add more query fields as needed
        ],
    ]),
    'mutation' => new ObjectType([
        'name' => 'Mutation',
        'fields' => [
            'createOrder' => [
                'type' => $orderType, // Define $orderType as per your requirements
                'args' => [
                    'productId' => ['type' => Type::id()],
                    'quantity' => ['type' => Type::int()],
                    // Add more fields as needed
                ],
                'resolve' => function ($rootValue, $args, $context, $info) {
                    // Implement logic to create an order
                    // This is a placeholder implementation
                    return ['id' => 1, 'productId' => $args['productId'], 'quantity' => $args['quantity']];
                },
            ],
        ],
    ]),
]);
