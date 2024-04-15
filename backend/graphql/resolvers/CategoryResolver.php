<?php

namespace App\GraphQL\Resolvers;

use App\Models\Category;
use App\Models\Product;

class CategoryResolver
{
    public function getAllCategories()
    {
        try {
            $categories = Category::all();
            $transformedCategories = [];

            foreach ($categories as $category) {
                $products = Product::where('category_id', $category->id)->get();
                $transformedCategory = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'description' => $category->description,
                    'products' => $products->toArray(),
                ];
                $transformedCategories[] = $transformedCategory;
            }

            return $transformedCategories;
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch categories');
        }
    }

    public function getCategory($args)
    {
        try {
            $category = Category::findOrFail($args['id']);
            $products = Product::where('category_id', $category->id)->get();
            $transformedCategory = [
                'id' => $category->id,
                'name' => $category->name,
                'description' => $category->description,
                'products' => $products->toArray(),
            ];
            return $transformedCategory;
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch category');
        }
    }
}
