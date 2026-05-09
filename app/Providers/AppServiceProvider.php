<?php
namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\GuideCategory;

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
    public function boot()
    {
        // Share dynamic pages with all frontend views
        if (Schema::hasTable('pages')) {
            $dynamicPages = Page::where('is_active', true)
                ->orderBy('order')
                ->get(['id', 'title', 'slug']);
            View::share('dynamicPages', $dynamicPages);
        }

        View::composer('*', function ($view) {
            $guideCategories = Schema::hasTable('guide_categories')
                ? GuideCategory::with('children')->whereNull('parent_id')->active()->orderBy('order')->get()
                : collect();
            $view->with('guideCategories', $guideCategories);
        });
    }
}
