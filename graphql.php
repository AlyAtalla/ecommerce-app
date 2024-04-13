<?php

// Import necessary classes and dependencies
require_once 'CategoryResolver.php'; // Assuming you have a CategoryResolver class
require_once 'schema.php'; // Assuming you have your GraphQL schema defined in a separate file

// Create an instance of CategoryResolver
$categoryResolver = new CategoryResolver();

// Define resolvers for your schema
$resolvers = [
    'Query' => [
        'getCategory' => function ($root, $args, $context) use ($categoryResolver) {
            // Call the getCategory method from your CategoryResolver
            return $categoryResolver->getCategory($args);
        },
        'getAllCategories' => function ($root, $args, $context) use ($categoryResolver) {
            // Call the getAllCategories method from your CategoryResolver
            return $categoryResolver->getAllCategories();
        },
    ],
    'Mutation' => [
        'createCategory' => function ($root, $args, $context) use ($categoryResolver) {
            // Call the createCategory method from your CategoryResolver
            return $categoryResolver->createCategory($args['input']);
        },
        'updateCategory' => function ($root, $args, $context) use ($categoryResolver) {
            // Call the updateCategory method from your CategoryResolver
            return $categoryResolver->updateCategory($args['input']);
        },
        'deleteCategory' => function ($root, $args, $context) use ($categoryResolver) {
            // Call the deleteCategory method from your CategoryResolver
            return $categoryResolver->deleteCategory($args['id']);
        },
    ],
];

// Create a GraphQL schema instance with your schema definition and resolvers
$schema = new Schema([
    'query' => $queryType,
    'mutation' => $mutationType,
    'resolvers' => $resolvers,
]);

// Set up your GraphQL server with the schema
// Your GraphQL server implementation details may vary based on the library you're using (e.g., webonyx/graphql-php)
// Here's a basic example using the webonyx/graphql-php library:
$server = new GraphQL\Server\StandardServer([
    'schema' => $schema,
]);

// Execute the server
$server->handleRequest();
