<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $tag_id
 * @property int $material_id
 */
class TagMaterial extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tag_material';

    public function scopeSearchForDelete($query, $request)
    {
        return $query->where([['tag_id', $request->tag],['material_id', $request->material]]);
    }
}
