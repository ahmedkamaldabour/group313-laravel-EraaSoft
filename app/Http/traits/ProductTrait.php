<?php

namespace App\Http\traits;

use App\Models\Category;

trait ProductTrait
{

    private function getAllCategories()
    {
        // code...
        return Category::get();
    }
}
