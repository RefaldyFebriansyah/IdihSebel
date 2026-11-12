<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    /**
     * Display the collective studio portfolio index.
     */
    public function index(): View
    {
        $members = Member::with(['skills', 'projects', 'experiences'])
            ->orderBy('index_number')
            ->get();

        $projects = Project::with('members')
            ->orderBy('year', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        $skills = Skill::with('members')
            ->orderBy('name')
            ->get();

        $skillsByCategory = $skills->groupBy('category');

        $stats = [
            'total_members' => $members->count(),
            'total_projects' => $projects->count(),
            'available_count' => $members->where('is_available', true)->count(),
            'categories_count' => $projects->pluck('category')->unique()->count(),
        ];

        return view('portfolio.index', compact(
            'members',
            'projects',
            'skills',
            'skillsByCategory',
            'stats'
        ));
    }

    /**
     * Display an individual member dossier page.
     */
    public function show(string $slug): View
    {
        $member = Member::with(['skills', 'projects.members', 'experiences'])
            ->where('slug', $slug)
            ->firstOrFail();

        $allMembers = Member::select('id', 'index_number', 'name', 'slug', 'role')
            ->orderBy('index_number')
            ->get();

        $memberSkillsByCategory = $member->skills->groupBy('category');

        return view('portfolio.show', compact(
            'member',
            'allMembers',
            'memberSkillsByCategory'
        ));
    }
}

