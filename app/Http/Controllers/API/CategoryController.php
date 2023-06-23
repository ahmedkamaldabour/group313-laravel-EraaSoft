<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\traits\ApiTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use function is_null;
use function response;

class CategoryController extends Controller
{
    use ApiTrait;
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return $this->apiResponse(200, 'Category created successfully', 'null', $category);
    }

    public function update(Request $request, Category $category)
    {
//        $category = Category::find($id);
//        if (is_null($category)) {
//            return $this->apiResponse(404, 'Category not found', 'null', 'null');
//        }
        $category->update($request->all());
        return $this->apiResponse(200, 'Category updated successfully', 'null', $category);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return $this->apiResponse(404, 'Category not found', 'null', 'null');
        }
        $category->delete();
        return $this->apiResponse(200, 'Category deleted successfully', 'null', 'null');
    }


}
