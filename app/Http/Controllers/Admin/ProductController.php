<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\traits\FileTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function redirect;
use function toast;


class ProductController extends Controller
{
    use FileTrait;

    public function index()
    {
        $products = Product::latest()->paginate();
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
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        $image_name = $this->uploadImage(Product::PATH, $request->file('image'));
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $image_name
        ]);
        toast('Product has been created successfully', 'success');
        return redirect()->route('products.index')
            ->with('success', 'Product has been created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::get();
        return view('Admin.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3|unique:products,name,' . $product->id,
            'description' => 'required|string|max:255|min:3',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image_name = $this->uploadImage(Product::PATH, $request->file('image'), $product->image);
        }
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $image_name ?? $product->image
        ]);
        toast('Product has been updated successfully', 'success');
        return redirect()->route('products.index')
            ->with('success', 'Product has been updated successfully');

    }

    public function destroy(Product $product)
    {
        $this->removeImage(Product::PATH, $product->image);
        $product->delete();
        toast('Product has been deleted successfully', 'success');
        return redirect()->route('products.index')
            ->with('success', 'Product has been deleted successfully');
    }


}
