<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Kaprodi\AchievementValidationController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/agenda', [PageController::class, 'agenda'])->name('agenda'); // Added name for agenda route
Route::get('/agenda/{agenda}', [PageController::class, 'showAgendaPublic'])->name('agenda.show.public');
Route::get('/announcements', [PageController::class, 'announcements'])->name('announcements.public.index');
Route::get('/announcements/{announcement}', [PageController::class, 'showAnnouncementPublic'])->name('announcements.public.show');

// Achievement Submission Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/achievements/create', [AchievementController::class, 'create'])->name('achievements.create');
    Route::post('/achievements', [AchievementController::class, 'store'])->name('achievements.store');
});

Route::get('/achievements/{achievement}', [PageController::class, 'showAchievementPublic'])->name('achievements.public.show');
Route::get('/documents/search', [PageController::class, 'searchDocuments'])->name('documents.search');
Route::get('/documents/filter', [PageController::class, 'filterDocuments'])->name('documents.filter');
Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities.index');
Route::get('/facilities/{facility}', [FacilityController::class, 'show'])->name('facilities.show');
Route::get('/kurikulum/{curriculum}', [PageController::class, 'showCurriculum'])->name('kurikulum.show');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


// Public route for submitting suggestions
Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['non.mahasiswa'])->group(function () {
        // Authenticated route for viewing suggestions (admin dashboard)
        Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');

        // Route to mark a suggestion as read
        Route::post('/suggestions/{suggestion}/mark-as-read', [SuggestionController::class, 'markAsRead'])->name('suggestions.markAsRead');

        // Route to view read suggestions
        Route::get('/suggestions/read', [SuggestionController::class, 'readSuggestions'])->name('suggestions.read');
    });

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::post('partners/{partner}/toggle-visibility', [PartnerController::class, 'toggleVisibility'])->name('partners.toggleVisibility');
        Route::post('agendas/{agenda}/toggle-publication', [AgendaController::class, 'togglePublication'])->name('agendas.togglePublication');
        Route::resource('agendas', AgendaController::class);
        Route::get('partners/export', [PartnerController::class, 'export'])->name('partners.export');
        Route::resource('partners', PartnerController::class);
        Route::post('documents/{document}/toggle-visibility', [\App\Http\Controllers\Admin\DocumentController::class, 'toggleVisibility'])->name('documents.toggleVisibility');
        Route::resource('documents', \App\Http\Controllers\Admin\DocumentController::class);
        Route::post('faqs/{faq}/toggle-visibility', [\App\Http\Controllers\Admin\FaqController::class, 'toggleVisibility'])->name('faqs.toggleVisibility');
        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class); // Add FAQ resource routes
        Route::post('announcements/{announcement}/toggle-publication', [\App\Http\Controllers\Admin\AnnouncementController::class, 'togglePublication'])->name('announcements.togglePublication');
        Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);
        Route::resource('facilities', AdminFacilityController::class);
        Route::resource('curriculums', \App\Http\Controllers\Admin\CurriculumController::class);
        Route::delete('curriculum-images/{curriculumImage}', [\App\Http\Controllers\Admin\CurriculumImageController::class, 'destroy'])->name('curriculum-images.destroy');
        Route::resource('users', UserController::class);
        Route::get('users-import', [UserController::class, 'showImportForm'])->name('users.importForm');
        Route::post('users-import', [UserController::class, 'importExcel'])->name('users.import');
        Route::get('users-export-template', [UserController::class, 'exportTemplate'])->name('users.exportTemplate');
    });

    // Kaprodi Routes
    Route::middleware(['kaprodi'])->name('kaprodi.')->prefix('kaprodi')->group(function () {
        Route::get('/achievements/export', [AchievementValidationController::class, 'export'])->name('achievements.export');
        Route::get('/achievements', [AchievementValidationController::class, 'index'])->name('achievements.index');
        Route::get('/achievements/{achievement}', [AchievementValidationController::class, 'show'])->name('achievements.show');
        Route::patch('/achievements/{achievement}', [AchievementValidationController::class, 'update'])->name('achievements.update');
        Route::delete('/achievements/{achievement}', [AchievementValidationController::class, 'destroy'])->name('achievements.destroy');
    });
});
