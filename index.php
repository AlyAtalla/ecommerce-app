<?php

// Include necessary files and autoloaders
require_once __DIR__ . '/vendor/autoload.php'; // Include Composer's autoloader
require_once __DIR__ . '/backend/config/config.php'; // Adjust path to config.php
require_once __DIR__ . '/backend/database/database.php'; // Include your database connection
require_once __DIR__ . '/backend/graphql/resolvers/CategoryResolver.php';
require_once __DIR__ . '/Router.php';

use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use MyNamespace\CategoryResolver; // Import your resolver classes
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

// Define GraphQL types
$categoryType = new ObjectType([
    'name' => 'Category',
    'fields' => [
        'id' => ['type' => Type::id()],
        'name' => ['type' => Type::string()],
        'description' => ['type' => Type::string()],
        // Add other fields as needed
    ],
]);

// Create a new instance of the database connection
$db = new Database();

// Create resolver instances
$categoryResolver = new CategoryResolver($db);

// Define GraphQL types
$categoryType = new ObjectType([
    'name' => 'Category',
    'fields' => [
        'id' => ['type' => Type::id()],
        'name' => ['type' => Type::string()],
        'description' => ['type' => Type::string()],
        // Add other fields as needed
    ],
]);

// Define GraphQL schema
$schema = new Schema([
    'query' => new ObjectType([
        'name' => 'Query',
        'fields' => [
            'getCategory' => [
                'type' => $categoryType,
                'args' => [
                    'id' => ['type' => Type::id()],
                ],
                'resolve' => function ($rootValue, $args, $context, $info) use ($categoryResolver) {
                    return $categoryResolver->getCategory($args);
                },
            ],
            'getAllCategories' => [
                'type' => Type::listOf($categoryType),
                'resolve' => function ($rootValue, $args, $context, $info) use ($categoryResolver) {
                    return $categoryResolver->getAllCategories();
                },
            ],
            // Add more query fields as needed
        ],
    ]),
    'mutation' => new ObjectType([
        'name' => 'Mutation',
        'fields' => [
            'createCategory' => [
                'type' => $categoryType,
                'args' => [
                    'name' => ['type' => Type::string()],
                    'description' => ['type' => Type::string()],
                ],
                'resolve' => function ($rootValue, $args, $context, $info) use ($categoryResolver) {
                    return $categoryResolver->createCategory($args);
                },
            ],
            'updateCategory' => [
                'type' => $categoryType,
                'args' => [
                    'id' => ['type' => Type::id()],
                    'name' => ['type' => Type::string()],
                    'description' => ['type' => Type::string()],
                ],
                'resolve' => function ($rootValue, $args, $context, $info) use ($categoryResolver) {
                    return $categoryResolver->updateCategory($args);
                },
            ],
            'deleteCategory' => [
                'type' => Type::boolean(),
                'args' => [
                    'id' => ['type' => Type::id()],
                ],
                'resolve' => function ($rootValue, $args, $context, $info) use ($categoryResolver) {
                    return $categoryResolver->deleteCategory($args);
                },
            ],
            // Add more mutation fields as needed
        ],
    ]),
]);


// Handle GraphQL request
try {
    // Ensure the request method is POST and the content type is application/json
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_SERVER['CONTENT_TYPE'] !== 'application/json') {
        throw new Exception('Invalid request method or content type.');
    }

    $input = file_get_contents('php://input');
    if (empty($input)) {
        throw new Exception('No query provided.');
    }

    // Parse the input JSON to ensure it's valid
    $inputData = json_decode($input, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON format.');
    }

    $result = GraphQL::executeQuery(
        $schema,
        $inputData['query'], // Use the query from the input data
        null,   // Root value (optional)
        ['db' => $db], // Context value (optional)
        isset($inputData['variables']) ? $inputData['variables'] : null // Query variables (optional)
    );

    // Output the result
    header('Content-Type: application/json');
    echo json_encode($result);
} catch (\Exception $e) {
    // Handle errors
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
