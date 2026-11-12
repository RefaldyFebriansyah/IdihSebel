<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'index_number',
        'name',
        'slug',
        'role',
        'specialization',
        'avatar_url',
        'short_bio',
        'about_story',
        'location',
        'email',
        'phone',
        'github_url',
        'linkedin_url',
        'instagram_url',
        'cv_url',
        'is_available',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }

    /**
     * The skills that belong to the member.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'member_skill')
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    /**
     * The projects that belong to the member.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_project')
            ->withPivot('specific_role')
            ->withTimestamps();
    }

    /**
     * The experiences that belong to the member.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class)->orderBy('id', 'asc');
    }
}

