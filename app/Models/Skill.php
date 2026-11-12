<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'svg_path',
    ];

    /**
     * The members that have this skill.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_skill')
            ->withPivot('is_primary')
            ->withTimestamps();
    }
}

