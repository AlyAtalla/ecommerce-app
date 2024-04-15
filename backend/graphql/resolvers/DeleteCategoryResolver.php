<?php

namespace Backend\GraphQL\Resolvers;

use App\Models\Category; // Assuming you have a Category model

class DeleteCategoryResolver
{
    public function resolve($args)
    {
        // Assuming $args contains 'id'
        $id = $args['id'];

        // Find the category by ID and delete it
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return true; // Indicate success
        }

        return false; // Indicate failure (category not found)
    }
}
