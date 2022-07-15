<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * @param Builder $query
     * @return Collection
     */
    public function scopeSorted(Builder $query): Collection
    {
        return $query->orderBy('name')->get();
    }

}

