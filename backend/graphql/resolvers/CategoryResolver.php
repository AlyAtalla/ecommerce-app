<?php

namespace App\GraphQL\Resolvers;

use App\Models\Category; // Assuming you have a Category model
use App\GraphQL\Resolvers\ProductResolver; // Import the ProductResolver

class CategoryResolver
{
    public function resolve($args)
    {
        // Fetch categories based on $args
        // This is a placeholder for your actual logic to fetch categories from your database
        $categories = Category::all(); // Example: fetch all categories

        // Transform the categories to match the GraphQL schema, including resolving products
        $transformedCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'products' => (new ProductResolver())->resolve(['categoryId' => $category->id]),
            ];
        });

        return $transformedCategories;
    }
}
