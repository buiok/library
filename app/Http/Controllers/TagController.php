<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStore;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::sorted();
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagStore $request
     * @return RedirectResponse
     */
    public function store(TagStore $request): RedirectResponse
    {
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Тег добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show(Tag $tag): \Illuminate\Contracts\View\View|Factory|Application
    {
        $materials = $tag->materials;
        return view('tag.show', compact('materials', 'tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Tag $tag): \Illuminate\Contracts\View\View|Factory|Application
    {
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagStore $request
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function update(TagStore $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success', 'Тег изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Тег удален');
    }
}
