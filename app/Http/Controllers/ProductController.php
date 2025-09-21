<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $products = Product::with(['category', 'subcategory', 'images'])->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        $categories = Category::where('is_active', 1)->get();
        $subcategories = Subcategory::where('is_active', 1)->get();
        return view('products.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        
        $product = Product::create($request->validated());
        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return Application|Factory|View
     */
    public function show(Product $product): Factory|View|Application
    {
        $product->load(['category', 'subcategory', 'images']);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return Application|Factory|View
     */
    public function edit(Product $product): Factory|View|Application
    {
        $categories = Category::where('is_active', 1)->get();
        $subcategories = Subcategory::where('is_active', 1)->get();
        return view('products.edit', compact('product', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {  
        $product->update($request->validated());
        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete associated images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    /**
     * Delete a specific product image.
     *
     * @param  Product  $product
     * @param  Image  $image
     * @return RedirectResponse
     */
    public function deleteImage(Product $product, Image $image): RedirectResponse
    {
        // Verify the image belongs to the product
        if ($image->imageable_id !== $product->id || $image->imageable_type !== Product::class) {
            abort(404, 'Image not found for this product');
        }
        
        // Delete file from storage
        Storage::disk('public')->delete($image->path);
        
        // Delete image record
        $image->delete();
        
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
