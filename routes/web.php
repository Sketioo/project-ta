<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AchievementController;

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
});