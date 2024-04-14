<?php

namespace App\GraphQL\Resolvers;

use App\Models\Category; // Assuming you have a Category model
use App\GraphQL\Resolvers\ProductResolver; // Import the ProductResolver

class CategoryResolver
{
    public function resolve($args)
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Transform the categories to match the GraphQL schema, including resolving products
        $transformedCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description, // Assuming 'description' is a field in your Category model
                'products' => (new ProductResolver())->resolve(['categoryId' => $category->id]),
            ];
        });

        return $transformedCategories;
    }
}
