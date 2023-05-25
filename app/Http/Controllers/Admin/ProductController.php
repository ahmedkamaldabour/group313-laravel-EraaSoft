<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();
        return view('Admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('Admin.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3|unique:products,name',
            'description' => 'required|string|max:255|min:3',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
//            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => 'product.png',
        ]);
        return redirect()->route('products.index')
            ->with('success', 'Product has been created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('Admin.pages.products.edit', compact('product', 'categories'));
    }
}
