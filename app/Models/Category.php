<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Material[] $materials
 */
class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}

