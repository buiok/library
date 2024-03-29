<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStore;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = Category::sorted();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStore $request
     * @return RedirectResponse
     */
    public function store(CategoryStore $request): RedirectResponse
    {
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Категория добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        $materials = $category->materials;
        return view('category.show', compact('materials', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryStore $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryStore $request, Category $category): RedirectResponse
    {
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Категория изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категория удалена');
    }
}
