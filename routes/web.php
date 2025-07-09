<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Kaprodi\AchievementValidationController;


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

Route::get('/', [PageController::class, 'home']);
Route::get('/agenda', [PageController::class, 'agenda'])->name('agenda'); // Added name for agenda route
Route::get('/agenda/{agenda}', [PageController::class, 'showAgendaPublic'])->name('agenda.show.public');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public route for submitting suggestions
Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalSuggestions = App\Models\Suggestion::count();
        return view('dashboard', compact('totalSuggestions'));
    })->name('dashboard');

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
    Route::middleware(['admin'])->group(function () {
        Route::resource('agendas', AgendaController::class);
    });

    // Kaprodi Routes
    Route::middleware(['kaprodi'])->name('kaprodi.')->prefix('kaprodi')->group(function () {
        Route::get('/achievements', [AchievementValidationController::class, 'index'])->name('achievements.index');
        Route::get('/achievements/{achievement}', [AchievementValidationController::class, 'show'])->name('achievements.show');
        Route::post('/achievements/{achievement}/validate', [AchievementValidationController::class, 'validateAchievement'])->name('achievements.validate');
        Route::post('/achievements/{achievement}/reject', [AchievementValidationController::class, 'rejectAchievement'])->name('achievements.reject');
    });
});