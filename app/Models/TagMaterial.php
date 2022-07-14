<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $tag_id
 * @property integer $material_id
 */
class TagMaterial extends Model
{
    use HasFactory;
    protected $guarded = [];
}
