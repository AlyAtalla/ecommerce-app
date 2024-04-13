<?php

namespace App\GraphQL\Resolvers;

use App\Models\Product; // Assuming you have a Product model
use App\GraphQL\Resolvers\AttributeResolver; // Import the AttributeResolver

class ProductResolver
{
    public function resolve($args)
    {
        // Fetch products based on $args
        // This is a placeholder for your actual logic to fetch products from your database
        $products = Product::all(); // Example: fetch all products

        // Transform the products to match the GraphQL schema, including resolving attributes
        $transformedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'attributes' => (new AttributeResolver())->resolve(['productId' => $product->id]),
            ];
        });

        return $transformedProducts;
    }
}
