<?php

namespace App\GraphQL\Resolvers;

use App\Models\Category; // Assuming you have a Category model

class UpdateCategoryResolver
{
    public function resolve($args)
    {
        // Assuming $args contains 'input' with 'id', 'name', and 'description'
        $id = $args['input']['id'];
        $name = $args['input']['name'];
        $description = $args['input']['description'];

        // Find the category by ID and update its fields
        $category = Category::find($id);
        if ($category) {
            $category->name = $name;
            $category->description = $description;
            $category->save();
        }

        // Return the updated category or null if not found
        return $category;
    }
}
