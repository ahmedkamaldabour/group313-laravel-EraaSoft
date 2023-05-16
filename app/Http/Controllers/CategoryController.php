<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use function redirect;
use function url;
use function view;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|min:3|max:50|unique:categories,name'
        ]);
        // store data
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        // category created successfully
        $request->session()->flash('success', 'Category has been created successfully');
        // redirect
        return redirect(url('categories'));

    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);
        // validation
        $request->validate([
            'name' => 'required|min:3|max:50|unique:categories,name,'. $id
        ]);
        $category->name = $request->name;
        $category->save();

        // category updated successfully
        return redirect(url('categories'))->with('success', 'Category has been updated successfully');
    }

    public function destroy(Category $category)
    {

        $category->delete();
        return redirect(url('categories'))->with('success', 'Category has been deleted successfully');
    }
}



