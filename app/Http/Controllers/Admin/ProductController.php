<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\FileTrait;
use App\Http\traits\ProductTrait;
use App\Models\Product;
use function redirect;
use function toast;


class ProductController extends Controller
{
    use FileTrait;
    use ProductTrait;

    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('Admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->getAllCategories();
        return view('Admin.pages.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $image_name = $this->uploadImage(Product::PATH, $request->file('image'));
        Product::create($request->validated() + ['image' => $image_name]);
        toast('Product has been created successfully', 'success');
        return redirect()->route('products.index')->with('success', 'Product has been created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = $this->getAllCategories();
        return view('Admin.pages.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $image_name = $this->uploadImage(Product::PATH, $request->file('image'), $product->image);
        }
        $product->update($request->validated() + ['image' => $image_name ?? $product->image]);
        toast('Product has been updated successfully', 'success');
        return redirect()->route('products.index')->with('success', 'Product has been updated successfully');

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
