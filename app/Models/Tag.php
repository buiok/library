<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property Material[] $materials
 */
class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'tag_material');
    }

    /**
     * @param Builder $query
     * @return Collection
     */
    public function scopeSorted(Builder $query): Collection
    {
        return $query->orderBy('name')->get();
    }

    /**
     * @param Builder $query
     * @param $material
     * @return Collection
     */
    public function scopeWithoutTagsMaterial(Builder $query, $material): Collection
    {
        $result = $query->select('tags.*')->leftJoin('tag_material', 'tags.id', '=', 'tag_id');

        foreach ($material->tags as $tag) {
            $result->where('tags.name' , '<>', $tag->name);
        }

        return $result->distinct('name')->orderBy('name')->get();
    }
}
