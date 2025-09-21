<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $subcategories = Subcategory::with('category')->paginate(10);
        return view('subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        $categories = Category::where('is_active', 1)->get();
        return view('subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSubcategoryRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreSubcategoryRequest $request): RedirectResponse
    {        
        Subcategory::create($request->validated());
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Subcategory  $subcategory
     * @return Application|Factory|View
     */
    public function show(Subcategory $subcategory): Factory|View|Application
    {
        $subcategory->load('category', 'products');
        return view('subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subcategory  $subcategory
     * @return Application|Factory|View
     */
    public function edit(Subcategory $subcategory): Factory|View|Application
    {
        $categories = Category::where('is_active', 1)->get();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubcategoryRequest  $request
     * @param  Subcategory  $subcategory
     * @return RedirectResponse
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory): RedirectResponse
    {
        $subcategory->update($request->validated());
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subcategory  $subcategory
     * @return RedirectResponse
     */
    public function destroy(Subcategory $subcategory): RedirectResponse
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}
