<?php

namespace App\Models;

class SearchMaterials
{
    /**
     * @param $search
     * @return mixed
     */
    public static function search($search): mixed
    {
        return Material::select('materials.*')->where('materials.name', 'LIKE', '%' . $search . '%')
            ->orWhere('author', 'LIKE', '%' . $search . '%')
            ->orWhere('categories.name', 'LIKE', '%' . $search . '%')
            ->orWhere('tags.name', 'LIKE', '%' . $search . '%')
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->leftJoin('tag_material', 'materials.id', '=', 'tag_material.material_id')
            ->leftJoin('tags', 'tag_id', '=', 'tags.id')->distinct()->get();
    }
}
