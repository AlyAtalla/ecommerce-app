<?php

namespace App\GraphQL\Resolvers;

use App\Models\Category; // Assuming you have a Category model

class CreateCategoryResolver
{
    public function resolve($args)
    {
        // Assuming $args contains 'input' with 'name' and 'description'
        $name = $args['input']['name'];
        $description = $args['input']['description'];

        // Create a new category in the database
        $category = new Category();
        $category->name = $name;
        $category->description = $description;
        $category->save();

        // Return the newly created category
        return $category;
    }
}
