<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\SearchMaterials;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;
use App\Models\Link;
use App\Models\Category;
use App\Models\TagMaterial;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $materials = Material::all();
        return view('material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::sorted();
        return view('material.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'type' => 'required',
        ];

        $request->validate($rules);
        $material = Material::create($request->all());

        return redirect()->route('materials.show', $material->id)->with('success', 'Материал успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param Material $material
     * @return View
     */
    public function show(Material $material): View
    {
        $tags = Tag::withoutTagsMaterial($material);
        return view('material.show', compact('material', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Material $material
     * @return View
     */
    public function edit(Material $material): View
    {
        $categories = Category::sorted();
        return view('material.edit', compact('material', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Material $material
     * @return RedirectResponse
     */
    public function update(Request $request, Material $material): RedirectResponse
    {
        $rules = [
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'type' => 'required',
        ];

        $request->validate($rules);
        $material->update($request->all());

        return redirect()->route('materials.show', $material->id)->with('success', 'Материал успешно изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Material $material
     * @return RedirectResponse
     */
    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Материал удален');
    }

    public function searchMaterial(Request $request): Factory|View|RedirectResponse|Application
    {
        $validator = Validator:: make($request->all(), ['search' => 'required|string']);
        if ($validator->fails()) {
            return redirect()->route('materials.index')->withErrors($validator, 'form_search');
        }

        $search = $request->search;
        $materials = SearchMaterials::search($search);

        return view('material.search', compact('materials', 'search'));
    }

    public function addTagMaterial(Request $request): RedirectResponse
    {
        $validator = Validator:: make($request->all(), [
           'tag' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('materials.show', $request->material_id)->withErrors($validator, 'form_addTag');
        }

        TagMaterial::create([
            'tag_id' => $request->tag,
            'material_id' => $request->material_id,
        ]);

        return redirect()->route('materials.show', $request->material_id)->with('success', 'Тег добавлен');
    }

    public function deleteTagMaterial(Request $request): RedirectResponse
    {
        TagMaterial::searchForDelete($request)->delete();
        return redirect()->route('materials.show', $request->material)->with('success', 'Тег удален');
    }

    public function addLinkMaterial(Request $request): RedirectResponse
    {
        $validator = Validator:: make($request->all(), [
           'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->route('materials.show', $request->material_id)->withErrors($validator, 'form_addLink');
        }

        Link::create([
            'material_id' => $request->material_id,
            'signature' => $request->signature,
            'url' => $request->url,
        ]);

        return redirect()->route('materials.show', $request->material_id)->with('success', 'Ссылка добавлена');
    }

    public function editLinkMaterial(Request $request): RedirectResponse
    {
        $validator = Validator:: make($request->all(), [
           'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->route('materials.show', $request->material_id)->withErrors($validator, 'form_editLink');
        }

        $link = Link::find($request->link_id);
        $link->update([
            'material_id' => $request->material_id,
            'signature' => $request->signature,
            'url' => $request->url,
        ]);

        return redirect()->route('materials.show', $request->material_id)->with('success', 'Ссылка изменена');
    }

    public function deleteLinkMaterial(Request $request): RedirectResponse
    {
        Link::where('id', $request->link)->delete();
        return redirect()->route('materials.index')->with('success', 'Ссылка удалена');
    }
}
