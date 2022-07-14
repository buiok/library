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
}
