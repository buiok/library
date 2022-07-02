<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Tag_Material;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();
        return view('material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('material.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'type' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Material::create($request->all());

        return redirect()->route('materials.index')->with('success', 'Материал успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $tagsM = Tag_Material::select('name')->join('tags', 'tag_id' , '=', 'tags.id')->where('material_id', $material->id)->get();
        $tags = Tag::whereNotIn('name', $tagsM)->orderBy('name')->get();

        return view('material.show', compact('material'), compact('tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        $categories = Category::orderBy('name')->get();
        return view('material.edit', compact('material'), compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $rules = [
            'name' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'type' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $material->update($request->all());

        return redirect()->route('materials.index')->with('success', 'Материал успешно изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Материал удален');
    }

    public function AddTagMaterial(Request $request)
    {
        $validatedData = $request->validate([ 'tag_id' => 'required' ]);

        Tag_Material::create([
            'tag_id' => $request->tag_id,
            'material_id' => $request->material_id,
        ]);

        return redirect()->route('materials.index')->with('success', 'Тег добавлен');
    }

    public function DeleteTagMaterial(Request $request)
    {
        $tag = Tag_Material::where([['tag_id', $request->tag],['material_id', $request->material]])->delete();

        return redirect()->route('materials.index')->with('success', 'Тег удален');
    }
}
