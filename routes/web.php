<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Kaprodi\AchievementValidationController;
use App\Http\Controllers\Admin\PartnerController;

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

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Public route for submitting suggestions
Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');

Route::middleware(['auth'])->group(function () {

    // Authenticated route for viewing suggestions (admin dashboard)
    Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');

    // Route to mark a suggestion as read
    Route::post('/suggestions/{suggestion}/mark-as-read', [SuggestionController::class, 'markAsRead'])->name('suggestions.markAsRead');

    // Route to view read suggestions
    Route::get('/suggestions/read', [SuggestionController::class, 'readSuggestions'])->name('suggestions.read');

    // Achievement Submission Routes
    Route::get('/achievements/create', [AchievementController::class, 'create'])->name('achievements.create');
    Route::post('/achievements', [AchievementController::class, 'store'])->name('achievements.store');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('agendas', AgendaController::class);
        Route::resource('partners', PartnerController::class)->except(['show', 'edit', 'update']);
    });

    // Kaprodi Routes
    Route::middleware(['kaprodi'])->name('kaprodi.')->prefix('kaprodi')->group(function () {
        Route::get('/achievements', [AchievementValidationController::class, 'index'])->name('achievements.index');
        Route::get('/achievements/{achievement}', [AchievementValidationController::class, 'show'])->name('achievements.show');
        Route::patch('/achievements/{achievement}', [AchievementValidationController::class, 'update'])->name('achievements.update');
    });
});
