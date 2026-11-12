<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'year',
        'category',
        'client_or_context',
        'thumbnail_url',
        'summary',
        'case_study',
        'tech_stack',
        'live_url',
        'repo_url',
        'is_featured',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * The members that collaborated on this project.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_project')
            ->withPivot('specific_role')
            ->withTimestamps();
    }
}

