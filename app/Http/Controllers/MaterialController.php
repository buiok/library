<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;
use App\Models\Link;
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
        $validator = Validator:: make($request->all(), [
           'tag' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('materials.show', $request->material_id)->withErrors($validator, 'form_addTag');
        }

        Tag_Material::create([
            'tag_id' => $request->tag,
            'material_id' => $request->material_id,
        ]);

        return redirect()->route('materials.index')->with('success', 'Тег добавлен');
    }

    public function DeleteTagMaterial(Request $request)
    {
        $tag = Tag_Material::where([['tag_id', $request->tag],['material_id', $request->material]])->delete();

        return redirect()->route('materials.index')->with('success', 'Тег удален');
    }

    public function AddLinkMaterial(Request $request)
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

        return redirect()->route('materials.index')->with('success', 'Ссылка добавлена');
    }

    public function EditLinkMaterial(Request $request)
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

        return redirect()->route('materials.index')->with('success', 'Ссылка изменена');
    }

    public function DeleteLinkMaterial(Request $request)
    {
        $tag = Link::where('id', $request->link)->delete();

        return redirect()->route('materials.index')->with('success', 'Ссылка удалена');
    }
}
