<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Member;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display main admin dashboard overview.
     */
    public function index(): View
    {
        $members = Member::with(['skills', 'projects'])->orderBy('index_number')->get();
        $projects = Project::with('members')->latest()->get();
        $skills = Skill::orderBy('category')->orderBy('name')->get();

        $stats = [
            'total_members' => $members->count(),
            'total_projects' => $projects->count(),
            'total_skills' => $skills->count(),
            'available_members' => $members->where('is_available', true)->count(),
        ];

        return view('admin.dashboard', compact('members', 'projects', 'skills', 'stats'));
    }

    /**
     * Show member edit form.
     */
    public function editMember(Member $member): View
    {
        $member->load(['skills', 'experiences', 'projects']);
        $allSkills = Skill::orderBy('category')->orderBy('name')->get();

        return view('admin.members.edit', compact('member', 'allSkills'));
    }

    /**
     * Update member profile and photo.
     */
    public function updateMember(Request $request, Member $member): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'specialization' => ['required', 'string', 'max:255'],
            'avatar_url' => ['nullable', 'string', 'max:1000'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'short_bio' => ['required', 'string', 'max:500'],
            'about_story' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'cv_url' => ['nullable', 'url', 'max:255'],
            'is_available' => ['nullable', 'boolean'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['exists:skills,id'],
        ]);

        // Handle uploaded avatar image file
        if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('avatars', 'public');
            $validated['avatar_url'] = '/storage/' . $path;
        }

        $validated['is_available'] = $request->has('is_available');
        unset($validated['avatar_file'], $validated['skills']);

        $member->update($validated);

        // Sync skills if provided
        if ($request->has('skills')) {
            $member->skills()->sync($request->input('skills'));
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "Profil {$member->name} (#{$member->index_number}) berhasil diperbarui!");
    }

    /**
     * Show create new project form.
     */
    public function createProject(): View
    {
        $members = Member::orderBy('index_number')->get();

        return view('admin.projects.create', compact('members'));
    }

    /**
     * Store new project and handle thumbnail.
     */
    public function storeProject(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:10'],
            'category' => ['required', 'string', 'max:100'],
            'client_or_context' => ['required', 'string', 'max:255'],
            'thumbnail_url' => ['nullable', 'string', 'max:1000'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'summary' => ['required', 'string', 'max:500'],
            'case_study' => ['required', 'string'],
            'tech_stack' => ['required', 'string'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'members' => ['nullable', 'array'],
            'member_roles' => ['nullable', 'array'],
        ]);

        // Generate unique slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }
        $validated['slug'] = $slug;

        // Handle uploaded thumbnail
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('projects', 'public');
            $validated['thumbnail_url'] = '/storage/' . $path;
        } elseif (empty($validated['thumbnail_url'])) {
            $validated['thumbnail_url'] = 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=1200&q=80';
        }

        // Parse comma-separated tech stack
        $techArray = array_map('trim', explode(',', $validated['tech_stack']));
        $validated['tech_stack'] = array_filter($techArray);
        $validated['is_featured'] = $request->has('is_featured');

        $membersInput = $validated['members'] ?? [];
        $memberRoles = $validated['member_roles'] ?? [];
        unset($validated['thumbnail_file'], $validated['members'], $validated['member_roles']);

        $project = Project::create($validated);

        // Attach members with specific roles
        if (!empty($membersInput)) {
            $attachData = [];
            foreach ($membersInput as $memberId) {
                $attachData[$memberId] = [
                    'specific_role' => $memberRoles[$memberId] ?? 'Software Engineer & Collaborator',
                ];
            }
            $project->members()->sync($attachData);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', "Proyek \"{$project->title}\" berhasil ditambahkan ke portofolio!");
    }

    /**
     * Show edit project form.
     */
    public function editProject(Project $project): View
    {
        $project->load('members');
        $members = Member::orderBy('index_number')->get();

        return view('admin.projects.edit', compact('project', 'members'));
    }

    /**
     * Update project details and thumbnail.
     */
    public function updateProject(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:10'],
            'category' => ['required', 'string', 'max:100'],
            'client_or_context' => ['required', 'string', 'max:255'],
            'thumbnail_url' => ['nullable', 'string', 'max:1000'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'summary' => ['required', 'string', 'max:500'],
            'case_study' => ['required', 'string'],
            'tech_stack' => ['required', 'string'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'members' => ['nullable', 'array'],
            'member_roles' => ['nullable', 'array'],
        ]);

        // Handle uploaded thumbnail
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('projects', 'public');
            $validated['thumbnail_url'] = '/storage/' . $path;
        }

        // Parse tech stack
        $techArray = array_map('trim', explode(',', $validated['tech_stack']));
        $validated['tech_stack'] = array_filter($techArray);
        $validated['is_featured'] = $request->has('is_featured');

        $membersInput = $validated['members'] ?? [];
        $memberRoles = $validated['member_roles'] ?? [];
        unset($validated['thumbnail_file'], $validated['members'], $validated['member_roles']);

        $project->update($validated);

        // Sync member contributors
        $attachData = [];
        foreach ($membersInput as $memberId) {
            $attachData[$memberId] = [
                'specific_role' => $memberRoles[$memberId] ?? 'Software Engineer & Collaborator',
            ];
        }
        $project->members()->sync($attachData);

        return redirect()->route('admin.dashboard')
            ->with('success', "Proyek \"{$project->title}\" berhasil diperbarui!");
    }

    /**
     * Delete project from portfolio.
     */
    public function destroyProject(Project $project): RedirectResponse
    {
        $title = $project->title;
        $project->members()->detach();
        $project->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', "Proyek \"{$title}\" berhasil dihapus!");
    }
}

