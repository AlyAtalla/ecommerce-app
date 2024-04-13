<?php

namespace App\GraphQL\Resolvers;

use App\Models\Attribute; // Assuming you have an Attribute model

class AttributeResolver
{
    public function resolve($args)
    {
        // Assuming $args contains 'productId' to fetch attributes for a specific product
        $productId = $args['productId'];

        // Fetch attributes for the given product ID
        // This is a placeholder for your actual logic to fetch attributes from your database
        $attributes = Attribute::where('product_id', $productId)->get();

        // Transform the attributes to match the GraphQL schema
        $transformedAttributes = $attributes->map(function ($attribute) {
            return [
                'id' => $attribute->id,
                'name' => $attribute->name,
                'value' => $attribute->value,
            ];
        });

        return $transformedAttributes;
    }
}
