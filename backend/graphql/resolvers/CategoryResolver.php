<?php

namespace Backend\GraphQL\Resolvers;

use Backend\Classes\Category;
use Backend\Classes\Product;
use Exception;

class CategoryResolver
{
    public function getAllCategories()
    {
        try {
            $categories = Category::all();
            $transformedCategories = [];

            foreach ($categories as $category) {
                // For each category, fetch associated products
                $products = $category->products()->get(); // Assuming you have defined a relationship between Category and Product models
                $transformedCategory = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'description' => $category->description,
                    'products' => $products->toArray(),
                ];
                $transformedCategories[] = $transformedCategory;
            }

            return $transformedCategories;
        } catch (Exception $e) {
            // Log the actual exception message for debugging
            error_log($e->getMessage());
            throw new Exception('Failed to fetch categories');
        }
    }

    public function getCategory($args)
    {
        try {
            $categoryId = $args['id'];

            // Fetch the category by ID
            $category = Category::findOrFail($categoryId);
            
            // Fetch associated products for this category
            $products = $category->products()->get(); // Assuming you have defined a relationship between Category and Product models

            // Transform the category and its products
            $transformedCategory = [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'products' => $products->toArray(),
            ];

            return $transformedCategory;
        } catch (Exception $e) {
            // Log the actual exception message for debugging
            error_log($e->getMessage());
            throw new Exception('Failed to fetch category');
        }
    }
}
