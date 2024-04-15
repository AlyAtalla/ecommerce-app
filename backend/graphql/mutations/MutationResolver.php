<?php

namespace Backend\GraphQL\Mutations;

use Backend\Classes\Category;
use Backend\Classes\Product;

class MutationResolver
{
    public function createCategory($rootValue, array $args)
    {
        // Implement logic to create a category
        $category = new Category();
        $category->name = $args['name'];
        $category->description = $args['description'];
        $category->save();

        return $category;
    }

    public function updateCategory($rootValue, array $args)
    {
        // Implement logic to update a category
        $category = Category::findOrFail($args['id']);
        $category->name = $args['name'];
        $category->description = $args['description'];
        $category->save();

        return $category;
    }

    public function deleteCategory($rootValue, array $args)
    {
        // Implement logic to delete a category
        $category = Category::findOrFail($args['id']);
        $category->delete();

        return true; // Indicate success
    }

    public function createProduct($rootValue, array $args)
    {
        // Implement logic to create a product
        $product = new Product();
        $product->name = $args['name'];
        $product->description = $args['description'];
        $product->category_id = $args['category_id'];
        $product->save();

        return $product;
    }

    public function updateProduct($rootValue, array $args)
    {
        // Implement logic to update a product
        $product = Product::findOrFail($args['id']);
        $product->name = $args['name'];
        $product->description = $args['description'];
        $product->category_id = $args['category_id'];
        $product->save();

        return $product;
    }

    public function deleteProduct($rootValue, array $args)
    {
        // Implement logic to delete a product
        $product = Product::findOrFail($args['id']);
        $product->delete();

        return true; // Indicate success
    }
}
