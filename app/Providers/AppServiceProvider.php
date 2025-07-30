<?php

namespace App\Providers;

use App\Models\Curriculum;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.header', function ($view) {
            $view->with('navCurriculums', Curriculum::where('is_visible', true)->latest()->get());
        });
    }
}
