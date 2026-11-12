<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Collective & Individual Portfolio Web Application routes.
|
*/

// Public Portfolio Routes
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/member/{slug}', [PortfolioController::class, 'show'])->name('portfolio.member');
Route::get('/project/{slug}', function (string $slug) {
    $project = \App\Models\Project::where('slug', $slug)->first();
    if ($project && !empty($project->live_url)) {
        return redirect()->away($project->live_url);
    }
    return redirect()->to(route('portfolio.index') . '#works');
})->name('portfolio.project');

// Authentication Routes
Route::get('/loginadmin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/loginadmin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/logoutadmin', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

// Admin Dashboard & Management Routes (Protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Member Profile Management
    Route::get('/members/{member}/edit', [AdminDashboardController::class, 'editMember'])->name('members.edit');
    Route::put('/members/{member}', [AdminDashboardController::class, 'updateMember'])->name('members.update');

    // Portfolio Projects Management
    Route::get('/projects/create', [AdminDashboardController::class, 'createProject'])->name('projects.create');
    Route::post('/projects', [AdminDashboardController::class, 'storeProject'])->name('projects.store');
    Route::get('/projects/{project}/edit', [AdminDashboardController::class, 'editProject'])->name('projects.edit');
    Route::put('/projects/{project}', [AdminDashboardController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{project}', [AdminDashboardController::class, 'destroyProject'])->name('projects.destroy');

    // Admin Account & Credentials Management
    Route::get('/profile', [AdminDashboardController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');
});

// Storage File Serving Fallback (Windows Environment Support)
Route::get('/storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/' . $path);
    if (! file_exists($filePath)) {
        abort(404);
    }

    $mimeType = @mime_content_type($filePath) ?: 'application/octet-stream';

    return response(file_get_contents($filePath), 200, [
        'Content-Type' => $mimeType,
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('path', '.*');
